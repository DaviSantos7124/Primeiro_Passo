<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $_SESSION['rua'] = $_POST['rua'];
    $_SESSION['cep_input'] = $_POST['cep'];
    $_SESSION['numero'] = $_POST['numero'];
    $_SESSION['complemento'] = $_POST['complemento'] ?? '';
    $_SESSION['cidade'] = $_POST['cidade'];
    $_SESSION['bairro'] = $_POST['bairro'];
    $_SESSION['estado'] = $_POST['estado'];



} elseif (!isset($_SESSION['nome'])) {
    header('Location: cadastro_empresa2.php');
    exit;
}

$erroEmail = $_SESSION['erroemail'] ?? '';
unset($_SESSION['erroemail']);


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cadastro empresa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <link rel="stylesheet" href="css/cadastro_empresa3.css">
  
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

        <h1 class="inter-medio" style=" margin-top:20px;">Cadastro da empresa</h1>
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
            <div class="bola">
                <h3 style="color: rgb(255, 255, 255);" class="inter-medio">3</h3>
            </div>
            <div style="background-color: #A4A4A4;width:24%;height:1px; "> </div>
            <div class="bola" style="background-color: #DCDDDF;">
                <h3 style="color:#1F2937" class="inter-medio">4</h3>
            </div>

        </div>

        <h2 class="inter-medio" style=" margin-top:45px;">Responsável</h2>
        <form action="cadastro_empresa4.php" method="post" id="formulario">
            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;" class="inter-medio">Nome
                completo</label>
            <div class="campo-cadastro inter-medio">
                <i class="bi bi-person"></i>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($_SESSION['nome'] ?? '')  ?>" placeholder="Digite o nome completo">
            </div>
 <span class="erro-campo" id="erro-nome"></span>

            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;" class="inter-medio">Cargo na
                empresa</label>
            <div class="campo-cadastro inter-medio">
                <i class="bi bi-person"></i>
                <input type="text" placeholder="Ex: Gerente de RH, Diretor, etc." id="cargo"  value="<?= htmlspecialchars($_SESSION['cargo'] ?? '')  ?>" name="cargo">
            </div>
             <span class="erro-campo" id="erro-cargo"></span>

            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;" class="inter-medio">E-mail de
                contato</label>
            <div class="campo-cadastro inter-medio">

                <i class="bi bi-house-door-fill"></i>
                <input type="text" id="email-contato" name="email-contato"  value="<?= htmlspecialchars($_SESSION['email-contato'] ?? '')  ?>" placeholder="exemplo@gmail.com">
            </div>
             <span class="erro-campo" id="erro-email-contato"></span>



            <label style="color: #1F2937; width:80%;margin-top: 10px; font-size:20px;"
                class="inter-medio">Telefone</label>
            <div class="campo-cadastro inter-medio">
                <i class="bi bi-telephone"></i>
                <input type="text" name="telefone-contato" placeholder="(00) 00000-0000"  value="<?= htmlspecialchars($_SESSION['telefone-contato'] ?? '')  ?>" id="celular">
            </div>
             <span class="erro-campo" id="erro-celular"></span>



            </div>
            <div class="botoes-cadastro">
                <button type="button" onclick="window.location.href='cadastro_empresa2.php'" class="btn-voltar">
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
    <script>
        let erroEmail = <?= json_encode($erroEmail) ?>;
    </script>
<script src="js/cadastro_empresa3.js"></script>


   
</body>

</html>