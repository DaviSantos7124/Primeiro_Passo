<?php
session_start();
include_once("../inc/config.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



if (isset($_POST['finalizar'])) {

    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
    $senha = password_hash($_SESSION['senha'], PASSWORD_DEFAULT);

    $telefone = $_SESSION['telefone'];

    $rua = $_SESSION['rua'];
    $cep = $_SESSION['cep_input'];
    $numero = $_SESSION['numero'];
    $complemento = $_SESSION['complemento'] ?? '';
    $cidade = $_SESSION['cidade'];
    $bairro = $_SESSION['bairro'];
    $estado = $_SESSION['estado'];

    

     
        $cadastro = $conexao->prepare("INSERT INTO tb_enderecos (nr_cep, ds_rua, nr_numero, ds_complemento, nm_bairro, nm_cidade, sg_uf) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $cadastro->bind_param(
            "sssssss",
            $cep,
            $rua,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $estado
        );

        $cadastro->execute();

        $idEndereco = $conexao->insert_id;


        $cadastro = $conexao->prepare("INSERT INTO tb_usuarios (nm_usuario, ds_email, ds_senha, ds_tipo) VALUES (?, ?, ?, 'aluno')");

        $cadastro->bind_param("sss", $nome, $email, $senha);

        $cadastro->execute();

        $idUsuario = $conexao->insert_id;


        $cadastro = $conexao->prepare("INSERT INTO tb_alunos (nm_aluno,  nr_telefone, id_usuario, id_endereco) VALUES (?,  ?, ?, ?)");

        $cadastro->bind_param(
            "ssii",
            $nome,
            $telefone,
            $idUsuario,
            $idEndereco
        );

        $cadastro->execute();

        $idAluno = $conexao->insert_id;



        unset(
            $_SESSION['nome'],
            $_SESSION['senha'],
            $_SESSION['confirmar-senha'],
            $_SESSION['nascimento'],
            $_SESSION['telefone'],
            $_SESSION['genero'],
            $_SESSION['estadoCivil'],
            $_SESSION['rua'],
            $_SESSION['cep_input'],
            $_SESSION['numero'],
            $_SESSION['complemento'],
            $_SESSION['cidade'],
            $_SESSION['bairro'],
            $_SESSION['estado']
        );

        header('Location: ../login.php');
        exit;

    } 
else{
       $_SESSION['habilidades'] = $_POST['habilidades'] ?? [];
    $_SESSION['experiencia'] = $_POST['experiencia'];
    $_SESSION['empresa'] = $_POST['empresa'] ?? "";
    $_SESSION['cargo'] = $_POST['cargo'] ?? "";
    $_SESSION['inicio'] = $_POST['inicio'] ?? "";
    $_SESSION['fim'] = $_POST['fim'] ?? "";

}





} else if(!isset($_SESSION['experiencia'])) {
   header('Location: cadastro_estudante4.php');
    exit;
} 



?><!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do aluno(a)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/cadastro_estudante5.css">
  
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
        <h1>Cadastro do aluno(a)</h1>
        <p class="sub">Revise suas informações antes de finalizar</p>
        <div class="passos">
            <div class="bola">1</div>
            <div class="linha"></div>
            <div class="bola">2</div>
            <div class="linha"></div>
            <div class="bola">3</div>
            <div class="linha"></div>
            <div class="bola">4</div>
            <div class="linha"></div>
            <div class="bola ativo">5</div>
        </div>
        <h2>Revise seus dados</h2>
        
            <div class="resumo">
                <div class="bloco"><i class="bi bi-person-vcard"></i>
                    <div>
                        <h4>Dados pessoais</h4>
                        <p>Nome: <?= htmlspecialchars($_SESSION['nome']) ?> </p>
                        <p>E-mail: <?= htmlspecialchars($_SESSION['email']) ?> </p>
                        <p>Telefone: <?= htmlspecialchars($_SESSION['telefone']) ?></p>
                    </div>
                </div>
                <div class="bloco"><i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <h4>Endereço</h4>
                        <p>Rua: <?= htmlspecialchars($_SESSION['rua']) ?>, <?= htmlspecialchars($_SESSION['numero']) ?>,
                            <?= htmlspecialchars($_SESSION['complemento']) ?>
                        </p>
                        <p>Bairro: <?= htmlspecialchars($_SESSION['bairro']) ?>,
                            <?= htmlspecialchars($_SESSION['cidade']) ?> - <?= htmlspecialchars($_SESSION['estado']) ?>
                        </p>
                        <p>CEP: <?= htmlspecialchars($_SESSION['cep_input']) ?></p>
                    </div>
                </div>
                <div class="bloco"><i class="bi bi-mortarboard-fill"></i>
                    <div>
                        <h4>Escolaridade</h4>
                        <p>Nível: <?= htmlspecialchars($_SESSION['nivel']) ?></p>
                        <p>Instituição: <?= htmlspecialchars($_SESSION['instituicao']) ?></p>
                        <p>Curso: <?= htmlspecialchars($_SESSION['curso']) ?></p>
                        <p>Conclusão: <?= htmlspecialchars($_SESSION['conclusao']) ?></p>
                    </div>
                </div>
                <div class="bloco"><i class="bi bi-briefcase-fill"></i>
                    <div>
                        <h4>Experiência</h4>
                        <?php if (($_SESSION['experiencia'] ?? '') === 'Sim'): ?>
                            <p>Empresa: <?= htmlspecialchars($_SESSION['empresa']) ?></p>
                            <p>Cargo: <?= htmlspecialchars($_SESSION['cargo']) ?></p>
                            <p>Início: <?= htmlspecialchars($_SESSION['inicio']) ?></p>
                            <p>Fim: <?= htmlspecialchars($_SESSION['empresa']) ?? 'Atual' ?></p>
                        <?php else: ?>
                            <p>Sem experiência informada</p>
                        <?php endif ?>

                        <p>Habilidades:
                            <?php
                            $habilidades = $_SESSION['habilidades'] ?? [];

                            if (is_array($habilidades) && count($habilidades) > 0) {
                                echo htmlspecialchars(implode(', ', $habilidades),ENT_QUOTES,'UTF-8');
                            } else {
                                echo 'Nenhuma habilidade selecionada';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
               <form method="post" action="cadastro_estudante5.php">
            <div class="botoes">

                <button type="button" onclick="window.location.href='cadastro_estudante4.php'" class="btn-voltar">
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