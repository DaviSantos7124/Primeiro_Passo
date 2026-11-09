<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $_SESSION['estudando'] = $_POST['estudando'];
    $_SESSION['nivel'] = $_POST['nivel'];
    $_SESSION['instituicao'] = $_POST['instituicao'];
    $_SESSION['curso'] = $_POST['curso'];
    $_SESSION['conclusao'] = $_POST['conclusao'];
    $_SESSION['complementar'] = $_POST['complementar'];
    $_SESSION['cursos_comp'] = $_POST['cursos_comp'] ?? '';
    $_SESSION['programa'] = $_POST['programa'];
    $_SESSION['area'] = $_POST['area'] ?? '';



} else if(!isset($_SESSION['experiencia'])) {
   header('Location: cadastro_estudante3.php');
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
      <link rel="stylesheet" href="css/cadastro_estudante4.css">
  
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
        <p class="sub">Agora, sobre sua experiência e habilidades</p>
        <div class="passos">
            <div class="bola">1</div>
            <div class="linha"></div>
            <div class="bola">2</div>
            <div class="linha"></div>
            <div class="bola">3</div>
            <div class="linha"></div>
            <div class="bola ativo">4</div>
            <div class="linha"></div>
            <div class="bola">5</div>
        </div>
        <h2>Informações profissionais</h2>
        <form action="cadastro_estudante5.php" method="post" id="formulario">
            <label>Você já teve alguma experiência profissional?</label>
            <div class="opcoes">
                <label>
                    <input type="radio"  <?php if (isset($_SESSION['experiencia']) && $_SESSION['experiencia'] == "Sim")
                        echo "checked"; ?> name="experiencia" value="Sim">
                    Sim
                </label>
                <label>
                    <input type="radio"  <?php if (isset($_SESSION['experiencia']) && $_SESSION['experiencia'] == "Não")
                        echo "checked"; ?>  name="experiencia" value="Não"> Não
                </label>

            </div>
            <h3 class="sec">Se sim, informe:</h3>
            <label>Empresa</label>
            <div class="campo">
                <i class="bi bi-building"></i>
                <input type="text" name="empresa" id="empresa"  value="<?=htmlspecialchars($_SESSION['empresa']?? "" )?>"  placeholder="Nome da empresa">
            </div>
             <span class="erro-campo" id="erro-empresa"></span>
            <label>Cargo</label>
            <div class="campo">
                <i class="bi bi-person-workspace"></i>
                <input type="text" name="cargo" id="cargo"  value="<?=htmlspecialchars($_SESSION['cargo']?? "" )?>"  placeholder="Ex: Auxiliar administrativo">
            </div>
             <span class="erro-campo" id="erro-cargo"></span>
            <div class="grid2">
                <div><label>Início</label>
                    <div class="campo">
                        <i class="bi bi-calendar"></i>
                        <input type="text" name="inicio" id="inicio"  value="<?=htmlspecialchars($_SESSION['inicio']?? "" )?>"  placeholder="Ex: 01/2024">
                    </div>
                    <span class="erro-campo" id="erro-inicio"></span>
                </div>
                <div><label>Fim</label>
                    <div class="campo">
                        <i class="bi bi-calendar"></i>
                        <input type="text" name="fim" id="fim"  value="<?=htmlspecialchars($_SESSION['fim']?? "" )?>"  placeholder="Ex: 12/2025">
                    </div>
                    <span class="erro-campo" id="erro-fim"></span>
                </div>
            </div>
            <h3 class="sec">Habilidades</h3>
            <p>Selecione suas habilidades</p>
            <div class="chips"><input type="checkbox" class="chk" id="hab1" name="habilidades[]"
                    value="Comunicação"><label class="chip" for="hab1">Comunicação</label><input type="checkbox"
                    class="chk" id="hab2" name="habilidades[]" value="Informática"><label class="chip"
                    for="hab2">Informática</label>
                <input type="checkbox" class="chk" id="hab3" name="habilidades[]" value="Organização"><label class="chip"
                    for="hab3">Organização</label><input type="checkbox" class="chk" id="hab4" name="habilidades[]"
                    value="Inglês"><label class="chip" for="hab4">Inglês</label>
                <input type="checkbox" class="chk" id="hab5" name="habilidades[]" value="Trabalho em equipe"><label
                    class="chip" for="hab5">Trabalho em equipe</label><input type="checkbox" class="chk" id="hab6"
                    name="habilidades[]" value="Espanhol">
                <label class="chip" for="hab6">Espanhol</label><input type="checkbox" class="chk" id="hab7"
                    name="habilidades[]" value="Boa aprendizagem"><label class="chip" for="hab7">Boa aprendizagem</label>
            </div>
            <div class="botoes">
                <button type="button" onclick="window.location.href='cadastro_estudante3.php'" class="btn-voltar">
                    Voltar
                </button>
                <button type="submit" class="btn-avancar">
                    Avançar <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </form>
        <div class="rodape">
            <hr><strong>© 2026 Primeiro Passo - Todos os direitos reservados.</strong>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script src="js/cadastro_estudante4.js"></script>
  
</body>

</html>