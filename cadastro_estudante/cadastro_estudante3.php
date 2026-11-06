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



} else if (!isset($_SESSION['estudando'])) {
    header('Location: cadastro_estudante2.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do aluno(a) - Escolaridade</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;350;400;450;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/cadastro_estudante3.css">
  
</head>

<body>

    <main>
        <div class="conteudo">

            <img src="../Imagem/logo.png" alt="Primeiro Passo" class="logo">

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
                        Explore oportunidades de primeiro emprego,
                        estágio e Jovem Aprendiz.
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
                        Monte um currículo simples e profissional
                        em poucos minutos.
                    </p>
                </div>
            </div>

            <div class="beneficio">
                <div class="icone">
                    <img src="../Imagem/Black.png" alt="">
                </div>

                <div class="texto-beneficio">
                    <h3 class="inter-medio">
                        Acompanhe suas candidaturas
                    </h3>
                    <p class="inter-pequeno">
                        Veja o status das suas inscrições e não
                        perca nenhuma oportunidade.
                    </p>
                </div>
            </div>

        </div>
    </main>

    <section class="login">

        <h1 class="inter-medio">Cadastro do aluno(a)</h1>

        <h5 class="subtitulo inter-pequeno_maior">
            Conte sobre sua escolaridade e cursos
        </h5>

        <div class="passos">
            <div class="bola">
                <h3>1</h3>
            </div>
            <div class="linha-passo"></div>
            <div class="bola">
                <h3>2</h3>
            </div>
            <div class="linha-passo"></div>
            <div class="bola ativo">
                <h3>3</h3>
            </div>
            <div class="linha-passo"></div>
            <div class="bola">
                <h3>4</h3>
            </div>
            <div class="linha-passo"></div>
            <div class="bola">
                <h3>5</h3>
            </div>
        </div>

        <h2 class="inter-medio">Escolaridade</h2>

        <form action="cadastro_estudante4.php" method="post" id="formulario">

            <label class="inter-medio">
                Você está estudando atualmente?
            </label>
            <!-- fazer logica php para verifacar qual esta selecionado-->
            <div class="opcoes">
                <label>

                    <input type="radio" name="estudando" value="Sim" <?php if (isset($_SESSION['estudando']) && $_SESSION['estudando'] == "Sim")
                        echo "checked"; ?>>
                    Sim
                </label>

                <label>
                    <input type="radio" name="estudando" value="Não" <?php if (isset($_SESSION['estudando']) && $_SESSION['estudando'] == "Não")
                        echo "checked"; ?>>
                    Não
                </label>
            </div>

            <label class="inter-medio">Nível de escolaridade</label>

            <div class="campo-cadastro inter-medio">
                <i class="bi bi-mortarboard"></i>

                <select name="nivel" id="nivel">
                    <option value="">Selecione o seu nível de escolaridade</option>

                    <?php
                    $niveis = [
                        "Ensino Médio (cursando)",
                        "Ensino Médio (completo)",
                        "Ensino Técnico (cursando)",
                        "Ensino Técnico (completo)",
                        "Ensino Superior (cursando)",
                        "Ensino Superior (completo)",
                        "Pós-graduação (cursando)",
                        "Pós-graduação (completo)",
                        "Mestrado (cursando)",
                        "Mestrado (completo)",
                        "Doutorado (cursando)",
                        "Doutorado (completo)"
                    ];

                    foreach ($niveis as $nivel):
                        ?>
                        <option value="<?php echo htmlspecialchars($nivel); ?>" <?php if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == $nivel)
                               echo "selected"; ?>>
                            <?php echo htmlspecialchars($nivel); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
            <span class="erro-campo" id="erro-nivel"></span>

            <label class="inter-medio">Instituição de ensino</label>

            <div class="campo-cadastro inter-medio">
                <i class="bi bi-bank"></i>
                <input type="text" name="instituicao" value='<?= htmlspecialchars($_SESSION['instituicao'] ?? '') ?>'
                    id="instituicao" placeholder="Nome da instituição">
            </div>
            <span class="erro-campo" id="erro-instituicao"></span>

            <div class="row-campo">

                <div class="grupo-campo">
                    <label class="inter-medio">Curso / Formação</label>

                    <div class="campo-cadastro2 inter-medio">
                        <i class="bi bi-journal-bookmark"></i>
                        <input type="text" name="curso" id="curso"
                            value='<?= htmlspecialchars($_SESSION['curso'] ?? '') ?>'
                            placeholder="Ex: Técnico em informática">
                    </div>
                    <span class="erro-campo" id="erro-curso"></span>
                </div>

                <div class="grupo-campo">
                    <label class="inter-medio">Data de conclusão (ou previsão)</label>

                    <div class="campo-cadastro2 inter-medio">
                        <i class="bi bi-calendar"></i>

                        <input type="text" name="conclusao"
                            value='<?= htmlspecialchars($_SESSION['conclusao'] ?? '') ?>' id="conclusao"
                            placeholder="Ex: 2026" maxlength="4" inputmode="numeric">
                    </div>

                    <span class="erro-campo" id="erro-conclusao"></span>
                </div>

            </div>

            <div class="row-campo">

                <div class="grupo-campo">
                    <label class="inter-medio">
                        Possui algum curso complementar?
                    </label>

                    <div class="opcoes">
                        <label>
                            <input type="radio" name="complementar" value="Sim" <?php if (isset($_SESSION['complementar']) && $_SESSION['complementar'] == "Sim")
                        echo "checked"; ?> >

                            Sim
                        </label>

                        <label>
                            <input type="radio" name="complementar" value="Não" <?php if (isset($_SESSION['complementar']) && $_SESSION['complementar'] == "Não")
                        echo "checked"; ?>>
                            Não
                        </label>
                    </div>
                </div>

                <div class="grupo-campo">
                    <label class="inter-medio">Se sim, qual(is)?</label>

                    <div class="campo-cadastro2 inter-medio">
                        <i class="bi bi-list-ul"></i>
                        <input type="text" name="cursos_comp" id="cursos_comp" value="<?=htmlspecialchars($_SESSION['cursos_comp']?? "" )?>" placeholder="Ex: Informática, Marketing">
                    </div>
                    <span class="erro-campo" id="erro-cursos_comp"></span>
                </div>

            </div>

            <div class="row-campo">

                <div class="grupo-campo">
                    <label class="inter-medio">
                        Já participou de algum programa de aprendizagem ou estágio?
                    </label>

                    <div class="opcoes">
                        <label>
                            <input type="radio" name="programa" value="Sim"  <?php if (isset($_SESSION['programa']) && $_SESSION['programa'] == "Sim")
                        echo "checked"; ?> >
                            Sim
                        </label>

                        <label>
                            <input type="radio" name="programa" value="Não"  <?php if (isset($_SESSION['programa']) && $_SESSION['programa'] == "Não")
                        echo "checked"; ?>>
                            Não
                        </label>
                    </div>
                </div>

                <div class="grupo-campo">
                    <label class="inter-medio">Em qual área?</label>

                    <div class="campo-cadastro2 inter-medio">
                        <i class="bi bi-briefcase"></i>
                        <input type="text" name="area" id="area" placeholder="Ex: Informática, Marketing"  value="<?=htmlspecialchars($_SESSION['area']?? "" )?>" >
                    </div>
                    <span class="erro-campo" id="erro-area"></span>
                </div>

            </div>

            <div class="botoes-cadastro">
                <button type="button" onclick="window.location.href='cadastro_estudante2.php'" class="btn-voltar">
                    Voltar
                </button>

                <button type="submit" name="Avançar" class="btn-avancar">
                    Avançar
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>

        </form>

        <div class="rodape">
            <hr>
            <strong>
                © 2026 Primeiro Passo - Todos os direitos reservados.
            </strong>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

   
<script src="js/cadastro_estudante3.js"></script>

</body>

</html>