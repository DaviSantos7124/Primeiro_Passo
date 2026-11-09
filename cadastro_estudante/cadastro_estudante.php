<?php
session_start();
$erroEmail = $_SESSION['erro'] ?? '';
unset($_SESSION['erro']);



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
  <link rel="stylesheet" href="css/cadastro_estudante.css">
  
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
        <p class="sub">Vamos começar com seus dados pessoais</p>
        <div class="passos">
            <div class="bola ativo">1</div>
            <div class="linha"></div>
            <div class="bola">2</div>
            <div class="linha"></div>
            <div class="bola">3</div>
            <div class="linha"></div>
            <div class="bola">4</div>
            <div class="linha"></div>
            <div class="bola">5</div>
        </div>
        <h2>Dados pessoais</h2>
        <form action="cadastro_estudante2.php" method="post" id="formulario">
            <div class="grupo-campo">
                <label>Nome</label>
                <div class="campo">
                    <i class="bi bi-person"></i>
                    <input required id="nome" type="text" name="nome"   value='<?= htmlspecialchars($_SESSION['nome'] ?? '') ?>' placeholder="Digite seu nome completo">

                </div>
                <span class="erro-campo" id="erro-nome"></span>
            </div>
            <div class="grupo-campo">
                <label>E-mail</label>
                <div class="campo">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" id="email"   value='<?= htmlspecialchars($_SESSION['email'] ?? '') ?>' required placeholder="exemplo@gmail.com">
                </div>
                <span class="erro-campo" id="erro-email"></span>
            </div>
            <div class="grupo-campo">
                <label>Telefone</label>
                <div class="campo">
                    <i class="bi bi-telephone"></i>
                    <input type="tel" id="celular" required name="telefone"   value='<?= htmlspecialchars($_SESSION['telefone'] ?? '') ?>' placeholder="(00) 00000-0000">
                </div>
                <span class="erro-campo" id="erro-celular"></span>
            </div>

            <div class="row-campo">
                <div class="grupo-campo">
                    <label>Senha</label>
                    <div class="campo">
                        <i class="bi bi-lock"></i>
                        <input type="password" required name="senha" id="senha"   value='<?= htmlspecialchars($_SESSION['senha'] ?? '') ?>' placeholder="Crie uma senha">
                    </div>
                    <span class="erro-campo" id="erro-senha"></span>
                </div>

                <div class="grupo-campo">
                    <label>Confirmar senha</label>
                    <div class="campo">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="confirmar-senha"   value='<?= htmlspecialchars($_SESSION['confirmar-senha'] ?? '') ?>' reqired id="confirmar-senha"
                            placeholder="Confirme sua senha">
                    </div>
                    <span class="erro-campo" id="erro-confirmar-senha"></span>
                </div>
            </div>

            <div class="botoes">

               <button type="button" onclick="window.location.href='../cadastro.php'" class="btn-voltar">
                    Voltar
                </button>

                <button type="submit" name="Avançar" class="btn-avancar">
                    Avançar
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </form>
        <div class="rodape">
            <hr><strong>© 2026 Primeiro Passo - Todos os direitos reservados.</strong>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
 <script> let erroEmail = <?= json_encode($erroEmail) ?>;
</script>
<script src="js/cadastro_estudante.js"></script>
    
</body>

</html>