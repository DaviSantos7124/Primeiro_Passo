<?php
session_start();

include_once("../inc/config.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['cep_input'])) {

        $cep = preg_replace('/\D/', '', $_POST['cep_input']);

        if (strlen($cep) != 8) {
            echo json_encode(['erro' => true]);
            exit;
        }

        $url = "https://viacep.com.br/ws/$cep/json/";

        $resposta = file_get_contents($url);

        if ($resposta === false) {
            echo json_encode(['erro' => true]);
            exit;
        }

        $dados = json_decode($resposta, true);

    } else {
        $_SESSION['nome'] = $_POST['nome'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['senha'] = $_POST['senha'];
        $_SESSION['confirmar-senha'] = $_POST['confirmar-senha'];
        $_SESSION['telefone'] = $_POST['telefone'];

        $email = $_SESSION['email'];

        $pesquisa = $conexao->prepare("SELECT cd_usuario FROM tb_usuarios WHERE ds_email = ?");
        $pesquisa->bind_param("s", $email);
        $pesquisa->execute();

        $resultado = $pesquisa->get_result();

        if ($resultado->num_rows != 0) {
            $_SESSION['erro'] = "Este e-mail já está cadastrado.";

            header('Location: cadastro_estudante.php');
            exit;

        }



    }

} else if (isset($_SESSION['cep_input'])) {
  echo  $_SESSION['cep_input'];
    exit;
}



?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/cadastro_estudante2.css">

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

        <h1 class="inter-medio" style=" margin-top:20px;">Cadastro do aluno(a)</h1>
        <h5 style="color: #1f293797; width:80%;margin-top: 10px;" class="inter-pequeno_maior">Agora, informe seu
            endereço completo</h5>
        <div class="row" style="align-items: center;margin-top: 20px;">
            <div class="bola" style="background-color: #DCDDDF;">
                <h3 style="color:#1F2937" class="inter-medio">1</h3>
            </div>
            <div style="background-color: #A4A4A4;width:24%;height:1px; "> </div>
            <div class="bola">
                <h3 style="color: rgb(255, 255, 255);" class="inter-medio">2</h3>
            </div>
            <div style="background-color: #A4A4A4;width:24%;height:1px; "> </div>
            <div class="bola" style="background-color: #DCDDDF;">
                <h3 style="color:#1F2937" class="inter-medio">3</h3>
            </div>
            <div style="background-color: #A4A4A4;width:24%;height:1px; "> </div>
            <div class="bola" style="background-color: #DCDDDF;">
                <h3 style="color:#1F2937" class="inter-medio">4</h3>
            </div>

        </div>

        <h2 class="inter-medio" style=" margin-top:45px;">Endereço da empresa</h2>
        <form action="cadastro_estudante2.php" method="post">
            <label class="inter-medio">CEP</label>

            <div class="linha-cep">
                <div class="campo-cadastro inter-medio">
                    <i class="bi bi-geo-alt"></i>
                    <input type="text" id="cep" name="cep_input"
                        value='<?= htmlspecialchars($dados['cep'] ?? $_SESSION['cep_input'] ?? '') ?>' placeholder="00000-000"
                        maxlength="9">
                </div>

                <button type="submit" id="buscar-cep" class="btn-cep">
                    Buscar CEP
                </button>
            </div>
        </form>
        <form action="cadastro_estudante3.php" method="post" id="formulario">
            <input type="hidden" name="cep" id="cep-hidden">
            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;" class="inter-medio">Rua</label>
            <div class="campo-cadastro inter-medio">
                <i class="bi bi-signpost-2-fill"></i>
                <input type="text" name="rua"
                    value='<?= htmlspecialchars($dados['logradouro'] ?? $_SESSION['rua'] ?? '') ?>' id="rua"
                    placeholder="Ex: Minha Rua">
            </div>
            <span class="erro-campo" id="erro-rua"></span>
            <div class="row-campo">
                <div class="grupo-campo">
                    <label class="inter-medio">Número</label>

                    <div class="campo-cadastro2 inter-medio">
                        <i class="bi bi-123"></i>
                        <input type="tel" placeholder="Ex: 123" name="numero"
                            value='<?= htmlspecialchars($_SESSION['numero'] ?? '') ?>' id="numero">
                    </div>
                    <span class="erro-campo" id="erro-numero"></span>
                </div>

                <div class="grupo-campo">
                    <label class="inter-medio">Complemento</label>

                    <div class="campo-cadastro2 inter-medio">

                        <input type="text" placeholder="Apto, bloco, etc."
                            value='<?= htmlspecialchars($_SESSION['complemento'] ?? '') ?>' name="complemento">
                    </div>

                </div>
            </div>

            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;"
                class="inter-medio">Bairro</label>
            <div class="campo-cadastro inter-medio">

                <i class="bi bi-house-door-fill"></i>
                <input type="text" placeholder="Digite o bairro" name="bairro"
                    value='<?= htmlspecialchars($dados['bairro'] ?? $_SESSION['bairro'] ?? '') ?>' id="bairro">
            </div>
            <span class="erro-campo" id="erro-bairro"></span>

            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;"
                class="inter-medio">Cidade</label>
            <div class="campo-cadastro inter-medio">
                <i class="bi bi-buildings"></i>
                <input type="text" placeholder="Selecione sua cidade"
                    value='<?= htmlspecialchars($dados['localidade'] ?? $_SESSION['cidade'] ?? '') ?>' name="cidade"
                    id="cidade">
            </div>
            <span class="erro-campo" id="erro-cidade"></span>
            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;"
                class="inter-medio">Estado</label>
            <div class="campo-cadastro inter-medio">
                <i class="bi bi-map"></i>
                <input type="text" maxlength="2" placeholder="Selecione seu estado" name="estado" id="estado"
                    value='<?= htmlspecialchars($dados['uf'] ?? $_SESSION['estado'] ?? '') ?>'>

            </div>
            <span class="erro-campo" id="erro-estado"></span>

            </div>
            <div class="botoes-cadastro">
                <button type="button" onclick="window.location.href='cadastro_estudante.php'" class="btn-voltar">
                    Voltar
                </button>

                <button type="submit" name="Avançar" class="btn-avancar">
                    Avançar
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>

        </form>
        <h5 style="color: #1f293797; width:80%;margin-top: 10px;" class="inter-pequeno_maior"></h5>

        <div style="background-color: #A4A4A4;width:100%;height:1px; margin-top:100px;"></div>
        <strong style="color: #A4A4A4; margin-top:10px;text-align: center; width:90%;">© 2026 Primeiro Passo - Todos os
            direitos reservados.</strong>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


    <script src="js/cadastro_estudante2.js"></script>

</body>

</html>