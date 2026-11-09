<?php
session_start();
include_once("inc/config.php");

$erro = "";

if (isset($_POST['entrar'])) {

    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $pesquisa = $conexao->prepare("SELECT cd_usuario, nm_usuario, ds_login, ds_email, ds_senha, ds_tipo, fl_ativo FROM tb_usuarios WHERE ds_email = ? OR ds_login = ? LIMIT 1");

    $pesquisa->bind_param("ss", $login, $login);
    $pesquisa->execute();

    $resultado = $pesquisa->get_result();

    if ($resultado->num_rows > 0) {

        $usuario = $resultado->fetch_assoc();

        if ($usuario['fl_ativo'] && !empty($usuario['ds_senha']) && password_verify($senha, $usuario['ds_senha'])) {


            $_SESSION['login'] = true;
            $_SESSION['id_usuario'] = $usuario['cd_usuario'];
            $_SESSION['nome'] = $usuario['nm_usuario'];
            $_SESSION['email'] = $usuario['ds_email'];
            $_SESSION['tipo'] = $usuario['ds_tipo'];
 

            header('Location: dashboard.php');
        } else {

            $erro = "E-mail ou senha incorretos.";

        }

    } else {

        $erro = "E-mail ou senha incorretos.";

    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
   
</head>

<body>

    <main>

        <div class="conteudo">

            <img src="Imagem/logo.png" class="logo">

            <h1 class="inter">
                O primeiro passo para o seu
                futuro profissional.
            </h1>

            <div class="beneficio">

                <div class="icone">
                    <img src="Imagem/account_circle.png" alt="">
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
                    <img src="Imagem/edit.png" alt="">
                </div>

                <div class="texto-beneficio">
                    <h3 class="inter-medio">Crie seu currículo</h3>

                    <p class="inter-pequeno">
                        Monte um currículo simples e profissional
                        em poucos minutos.
                    </p>
                </div>

            </div>

            <div class="beneficio">

                <div class="icone">
                    <img src="Imagem/Black.png" alt="">
                </div>

                <div class="texto-beneficio">
                    <h3 class="inter-medio">Acompanhe suas candidaturas</h3>

                    <p class="inter-pequeno">
                        Veja o status das suas inscrições e não
                        perca nenhuma oportunidade.
                    </p>
                </div>

            </div>

        </div>

    </main>

    <section class="login">

        <h1 style="color: #1F2937;padding-top:50px;" class="inter">Bem-vindo de volta!</h1>
        <h4 style="color: #1f29378f;" class="inter-medio">Faça login para continuar na sua jornada.</h4>
        <form method="post" action="login.php">
            <div class="campo-login inter-medio">
                <i class="bi bi-person"></i>
                <input type="text" required name="login" placeholder="Usuário ou e-mail">
            </div>
            <div class="campo-login inter-medio">
                <i class="bi bi-lock"></i>
                <input type="password" required name="senha" placeholder="Senha">

            </div>
            <?php if (!empty($erro)): ?>
                <p style="color: red; margin-top: 10px; width: 90%;">
                    <?= htmlspecialchars($erro) ?>
                </p>
            <?php endif; ?>
            <a href="Recuperar_senha.html" class="inter-medio a_senha">Esqueceu sua senha?</a>

            <button type="submit" name="entrar"
                style=" display: flex; 
    align-items: center;
    justify-content: center;
    position: relative;background-color: #1A80D5; border:none; width:90%;margin-top:30px; height: 50px;border-radius:10px;color:#fff ;">
                <h3>Entrar</h3>
                <i class="bi bi-arrow-right" style="padding-left: 20px; font-size:20px;"></i>
            </button>
        </form>
        <p style="color: #8f8f8f; text-align: center;width:90%; font-size: 20px;margin-top:5px;">ou</p>

        <button class="botao-google">
            <i class="fa-brands fa-google"></i>
            <h3>Entrar com o Google</h3>
        </button>
        <a href="cadastro.php" class="" style="text-align: center; width:90%; margin-top:10px;"><span
                style="color: #1f2937ca;"> Ainda não tem uma conta?</span> Cadastre-se</a>
        <div style="background-color: #A4A4A4;width:90%;height:1px; margin-top:130px;"></div>
        <strong style="color: #A4A4A4; margin-top:10px;text-align: center; width:90%;">© 2026 Primeiro Passo - Todos os
            direitos reservados.</strong>
    </section>

</body>

</html>