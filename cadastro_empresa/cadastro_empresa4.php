<?php
session_start();

include_once("../inc/config.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


if (isset($_POST['finalizar'])) {

    $razao = $_SESSION['razao'];
    $nomeFantasia = $_SESSION['nomeFantasia'];
    $cnpj = !empty($_SESSION['cnpj']) ? $_SESSION['cnpj'] : null;
    $emailEmpresa = $_SESSION['email'];
    $telefoneEmpresa = $_SESSION['telefone'];

    $rua = $_SESSION['rua'];
    $cep = $_SESSION['cep_input'];
    $numero = $_SESSION['numero'];
    $complemento = $_SESSION['complemento'] ?? '';
    $cidade = $_SESSION['cidade'];
    $bairro = $_SESSION['bairro'];
    $estado = $_SESSION['estado'];

    $nome = $_SESSION['nome'];
    $cargo = $_SESSION['cargo'];
    $emailContato = $_SESSION['email-contato'];
    $telefoneContato = $_SESSION['telefone-contato'];

    $senha = password_hash($_SESSION['senha'], PASSWORD_DEFAULT);



    $cadastro = $conexao->prepare("INSERT INTO tb_enderecos   (nr_cep, ds_rua, nr_numero, ds_complemento, nm_bairro, nm_cidade, sg_uf)   VALUES (?, ?, ?, ?, ?, ?, ?)");
    $cadastro->bind_param("sssssss", $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado);

    $cadastro->execute();

    $idEndereco = $conexao->insert_id;

    $cadastro = $conexao->prepare("INSERT INTO tb_usuarios (nm_usuario, ds_email, ds_senha, ds_tipo)VALUES (?, ?, ?, 'empresa')");
    $cadastro->bind_param("sss", $nome, $emailContato, $senha);
    $cadastro->execute();
    $idUsuario = $conexao->insert_id;

    $cadastro = $conexao->prepare("INSERT INTO tb_empresas (nm_razao_social, nm_fantasia, nr_cnpj, nm_email_corporativo,nr_telefone, id_usuario, id_endereco)VALUES (?, ?, ?, ?, ?, ?, ?)");

    $cadastro->bind_param("sssssii", $razao, $nomeFantasia, $cnpj, $emailEmpresa, $telefoneEmpresa, $idUsuario, $idEndereco);

    $cadastro->execute();

    $idEmpresa = $conexao->insert_id;

    $permissao = 'Administrador';

    $cadastro = $conexao->prepare("INSERT INTO tb_membros_empresa (ds_cargo, nr_telefone_contato, ds_permissao, id_empresa, id_usuario)   VALUES (?, ?, ?, ?, ?)");

    $cadastro->bind_param(
        "sssii",
        $cargo,
        $telefoneContato,
        $permissao,
        $idEmpresa,
        $idUsuario
    );

    $cadastro->execute();

    $conexao->commit();

    unset(
        $_SESSION['razao'],
        $_SESSION['nomeFantasia'],
        $_SESSION['cnpj'],
        $_SESSION['email'],
        $_SESSION['senha'],
        $_SESSION['confirmar-senha'],
        $_SESSION['telefone'],
        $_SESSION['rua'],
        $_SESSION['cep_input'],
        $_SESSION['numero'],
        $_SESSION['complemento'],
        $_SESSION['cidade'],
        $_SESSION['bairro'],
        $_SESSION['estado'],
        $_SESSION['nome'],
        $_SESSION['cargo'],
        $_SESSION['telefone-contato']
    );

    header('Location: ../login.php');
    exit;


}else{
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['cargo'] = $_POST['cargo'];
    $_SESSION['email-contato'] = $_POST['email-contato'];
    $_SESSION['telefone-contato'] = $_POST['telefone-contato'];





    $email = $_SESSION['email-contato'];

    $pesquisa = $conexao->prepare("SELECT cd_usuario FROM tb_usuarios WHERE ds_email = ?");
    $pesquisa->bind_param("s", $email);
    $pesquisa->execute();

    $resultado = $pesquisa->get_result();

    if ($resultado->num_rows != 0) {
        $_SESSION['erroemail'] = "Este e-mail já está cadastrado.";

        header('Location: cadastro_empresa3.php');
        exit;

    }



}

} elseif (!isset($_SESSION['nome'])) {
    header('Location: cadastro_empresa3.php');
    exit;
}


?><!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro da empresa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/cadastro_empresa4.css">

</head>

<body>

    <main>

        <div class="conteudo">

            <img src="../Imagem/logo.png" alt="" class="logo">

            <h1 class="inter">
                O primeiro passo para o seu futuro profissional.
            </h1>

            <div class="beneficio">

                <div class="icone">
                    <img src="../Imagem/account_circle.png" alt="">
                </div>

                <div class="texto-beneficio">
                    <h3 class="inter-medio">Encontre vagas</h3>

                    <p class="inter-pequeno">
                        Explore oportunidades de primeiro emprego, estágio e Jovem Aprendiz.
                    </p>
                </div>

            </div>

            <div class="beneficio">

                <div class="icone">
                    <img src="../Imagem/edit.png" alt="">
                </div>

                <div class="texto-beneficio">
                    <h3 class="inter-medio">Crie seu currículo</h3>

                    <p class="inter-pequeno">
                        Monte um currículo simples e profissional em poucos minutos.
                    </p>
                </div>

            </div>

            <div class="beneficio">

                <div class="icone">
                    <img src="../Imagem/Black.png" alt="">
                </div>

                <div class="texto-beneficio">
                    <h3 class="inter-medio">Acompanhe suas candidaturas</h3>

                    <p class="inter-pequeno">
                        Veja o status das suas inscrições e não perca nenhuma oportunidade.
                    </p>
                </div>

            </div>

        </div>

    </main>

    <section class="login">

        <h1 class="inter-medio" style=" margin-top:0px;">Cadastro da empresa</h1>
        <h5 style="color: #1f293797; width:80%;margin-top: 10px;" class="inter-pequeno_maior">Vamos começar com os dados
            da sua empresa.</h5>
        <div class="row" style="align-items: center;margin-top: 20px;">
            <div class="bola" style="background-color: #DCDDDF;">
                <h3 style="color:#1F2937" class="inter-medio">1</h3>
            </div>
            <div style="background-color: #A4A4A4;width:24%;height:1px; "> </div>
            <div class="bola" style="background-color: #DCDDDF;">
                <h3 style="color:#1F2937" class="inter-medio">2</h3>
            </div>
            <div style="background-color: #A4A4A4;width:24%;height:1px; "> </div>
            <div class="bola" style="background-color: #DCDDDF;">
                <h3 style="color:#1F2937;" class="inter-medio">3</h3>
            </div>
            <div style="background-color: #A4A4A4;width:24%;height:1px; "> </div>
            <div class="bola">
                <h3 style="color: rgb(255, 255, 255);" class="inter-medio">4</h3>
            </div>

        </div>
        <h2>Revise seus dados</h2>
     
            <div class="resumo">

                <div class="bloco">
                    <i class="bi bi-building"></i>
                    <div>
                        <h4>Dados da empresa</h4>

                        <p>Razão social: <?= htmlspecialchars($_SESSION['razao']) ?></p>
                        <p>Nome fantasia: <?= htmlspecialchars($_SESSION['nomeFantasia']) ?></p>
                        <p>CNPJ: <?= htmlspecialchars($_SESSION['cnpj']) ?></p>
                        <p>E-mail: <?= htmlspecialchars($_SESSION['email']) ?></p>
                        <p>Telefone: <?= htmlspecialchars($_SESSION['telefone']) ?></p>
                    </div>
                </div>

                <div class="bloco">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <h4>Endereço da empresa</h4>

                        <p>Rua: <?= htmlspecialchars($_SESSION['rua']) ?>, <?= htmlspecialchars($_SESSION['numero']) ?>
                        </p>
                        <p>Complemento: <?= htmlspecialchars($_SESSION['complemento']) ?></p>
                        <p>Bairro: <?= htmlspecialchars($_SESSION['bairro']) ?></p>
                        <p>Cidade: <?= htmlspecialchars($_SESSION['cidade']) ?> -
                            <?= htmlspecialchars($_SESSION['estado']) ?>
                        </p>
                        <p>CEP: <?= htmlspecialchars($_SESSION['cep_input']) ?></p>
                    </div>
                </div>

                <div class="bloco">
                    <i class="bi bi-person-vcard"></i>
                    <div>
                        <h4>Responsável pelo contato</h4>

                        <p>Nome: <?= htmlspecialchars($_SESSION['nome']) ?></p>
                        <p>Cargo: <?= htmlspecialchars($_SESSION['cargo']) ?></p>
                        <p>E-mail: <?= htmlspecialchars($_SESSION['email-contato']) ?></p>
                        <p>Telefone: <?= htmlspecialchars($_SESSION['telefone-contato']) ?></p>
                    </div>
                </div>

            </div>
            <form method="post" action="cadastro_empresa4.php">
            <div class="botoes">

                <button type="button" onclick="window.location.href='cadastro_empresa3.php'" class="btn-voltar">
                    Voltar
                </button>

                <button type="submit" name="finalizar" class="btn-avancar">
                    Avançar
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </form>
        <div class="rodape">
            <hr><strong>© 2026 Primeiro Passo - Todos os direitos reservados.</strong>
        </div>
    </section>
</body>

</html>