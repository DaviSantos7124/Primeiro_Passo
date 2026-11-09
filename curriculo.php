<?php
include_once('inc/verificacao_login.php');

//verificar dados do usuario parzza exibir dinamicamente nome na sesao e outros dados se precisar

?><!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Currículo - Primeiro Passo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            background: #F3F6FB;
            color: #1F2937;
            font-family: "Inter", sans-serif;
            font-weight: 450;
            font-size: 15px
        }

        a,
        a:hover {
            text-decoration: none;
            color: inherit
        }

        h1,
        h2,
        h3,
        h4,
        p {
            margin: 0
        }

        .menu {
            width: 235px;
            flex-shrink: 0;
            background: #002546;
            height: 100vh;
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 14px
        }

        .menu .logo {
            width: 150px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 34px
        }

        .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #fff;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 14px
        }

        .menu a i {
            font-size: 20px;
            flex-shrink: 0
        }

        .menu a:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff
        }

        .menu a.ativo {
            background: #1A80D5;
            color: #fff
        }

        .pagina {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh
        }

        .topo {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #fff;
            padding: 14px 24px;
            border-bottom: 1px solid #DDE3EC
        }

        .busca {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #F3F6FB;
            border: 1px solid #DDE3EC;
            border-radius: 30px;
            padding: 0 16px;
            height: 40px;
            margin: 0
        }

        .busca i {
            color: #6B7280
        }

        .busca input {
            flex: 1;
            min-width: 0;
            border: 0;
            outline: 0;
            background: transparent;
            font: inherit;
            font-size: 14px
        }

        .sino {
            font-size: 20px
        }

        .usuario {
            position: relative
        }

        .usuario summary {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-weight: 600
        }

        .usuario summary::-webkit-details-marker {
            display: none
        }

        .usuario summary>i:first-child {
            font-size: 34px
        }

        .usuario .sub {
            position: absolute;
            right: 0;
            top: 46px;
            background: #fff;
            border: 1px solid #DDE3EC;
            border-radius: 10px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .12);
            min-width: 160px;
            padding: 6px;
            z-index: 5
        }

        .usuario .sub a {
            display: block;
            padding: 9px 12px;
            border-radius: 6px;
            font-size: 14px
        }

        .usuario .sub a:hover {
            background: #F3F6FB
        }

        .conteudo {
            flex: 1;
            padding: 20px 24px
        }

        .grade {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 20px;
            align-items: start
        }

        .col-esq,
        .col-dir {
            display: flex;
            flex-direction: column;
            gap: 20px;
            min-width: 0
        }

        .card {
            background: #fff;
            border: 1px solid #DDE3EC;
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
            padding: 20px
        }

        .cab {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px
        }

        .cab h2 {
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px
        }

        .cab h2 i,
        .perfil-card h3 i {
            color: #1A80D5
        }

        .ver-todas {
            color: #1A80D5 !important;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #1A80D5;
            color: #fff;
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            border: 0
        }

        .btn:hover {
            background: #176eb5;
            color: #fff
        }

        .btn.vazado {
            background: #fff;
            color: #1A80D5;
            border: 1px solid #1A80D5
        }

        .perfil-card {
            display: flex;
            flex-direction: column;
            gap: 14px
        }

        .perfil-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px
        }

        .perfil-corpo {
            display: flex;
            align-items: center;
            gap: 16px
        }

        .rosca {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            flex-shrink: 0;
            background: conic-gradient(#1A80D5 calc(var(--p)*1%), #E5E7EB 0);
            display: flex;
            align-items: center;
            justify-content: center
        }

        .rosca span {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700
        }

        .perfil-corpo h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px
        }

        .perfil-corpo p {
            font-size: 12px;
            color: #6B7280;
            font-weight: 350
        }

        .acesso h3 {
            text-align: center;
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 16px
        }

        .atalhos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px
        }

        .atalho {
            border: 1px solid #DDE3EC;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
            padding: 14px 8px;
            text-align: center
        }

        .atalho:hover {
            border-color: #1A80D5
        }

        .atalho .circ {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid #1A80D5;
            color: #1A80D5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin: 0 auto 8px
        }

        .atalho h4 {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px
        }

        .atalho p {
            font-size: 11.5px;
            color: #6B7280;
            font-weight: 350
        }

        .rodape {
            padding: 0 24px 20px
        }

        .rodape hr {
            border-top: 1px solid #C9D0DA;
            margin: 10px 0
        }

        .rodape p {
            text-align: center;
            color: #9AA3AF;
            font-size: 12px
        }

        @media(max-width:1100px) {
            .grade {
                grid-template-columns: 1fr
            }

            .col-dir {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr))
            }
        }

        @media(max-width:900px) {
            .menu {
                width: 72px;
                padding: 20px 10px
            }

            .menu .logo,
            .menu a span {
                display: none
            }

            .menu a {
                justify-content: center;
                padding: 12px
            }
        }

        @media(max-width:640px) {
            body {
                flex-direction: column-reverse;
                padding-bottom: 64px
            }

            .menu {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                height: 64px;
                flex-direction: row;
                padding: 0 6px;
                z-index: 10;
                top: auto
            }

            .menu ul {
                flex-direction: row;
                justify-content: space-around;
                gap: 0
            }

            .menu li {
                flex: 1
            }

            .menu a {
                justify-content: center;
                padding: 10px 0
            }

            .pagina {
                min-height: 0
            }

            .topo {
                padding: 12px 16px;
                gap: 14px
            }

            .usuario summary span {
                display: none
            }

            .conteudo {
                padding: 16px
            }

            .rodape {
                padding: 0 16px 20px
            }
        }

        /* ===== Estilos desta tela ===== */

        .intro small {
            color: #1A80D5;
            font-weight: 700;
            letter-spacing: .5px
        }

        .intro h1 {
            font-size: 1.6rem;
            font-weight: 600;
            margin: 6px 0
        }

        .intro p {
            color: #6B7280;
            max-width: 560px
        }

        .progresso h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 4px
        }

        .progresso p {
            font-size: 13px;
            color: #6B7280;
            margin-bottom: 10px
        }

        .barra {
            height: 8px;
            background: #E5E7EB;
            border-radius: 6px;
            overflow: hidden
        }

        .barra div {
            height: 100%;
            width: 100%;
            background: #1A80D5
        }

        .progresso {
            display: flex;
            align-items: center;
            gap: 18px
        }

        .progresso>div:last-child {
            flex: 1
        }

        .infos {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px
        }

        .info {
            position: relative;
            border: 1px solid #DDE3EC;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-height: 130px
        }

        .info:hover {
            border-color: #1A80D5
        }

        .info .ic {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            border: 1.5px solid #1A80D5;
            background: #E8F2FC;
            color: #1A80D5;
            font-size: 19px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .info h4 {
            font-size: 14px;
            font-weight: 600
        }

        .info p {
            font-size: 12px;
            color: #6B7280;
            font-weight: 350
        }

        .info .ok {
            position: absolute;
            top: 12px;
            right: 12px;
            color: #22A05A;
            font-size: 18px
        }

        .visual {
            display: flex;
            gap: 18px;
            align-items: flex-start
        }

        .folha {
            flex: 1;
            border: 1px solid #DDE3EC;
            border-radius: 10px;
            padding: 16px;
            display: flex;
            gap: 16px;
            background: #fff
        }

        .folha .foto {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            background: #E8F2FC;
            color: #1A80D5;
            font-size: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .folha h4 {
            font-size: 1rem;
            font-weight: 700
        }

        .folha .cargo {
            font-size: 13px;
            color: #1A80D5;
            font-weight: 600
        }

        .folha .ct {
            display: flex;
            flex-wrap: wrap;
            gap: 4px 18px;
            font-size: 12px;
            color: #6B7280;
            margin: 6px 0
        }

        .folha .ct i {
            margin-right: 4px
        }

        .folha p {
            font-size: 12.5px
        }

        .dicas h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px
        }

        .dicas h3 i {
            color: #1A80D5
        }

        .dicas ol {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 14px
        }

        .dicas li {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            font-size: 13px
        }

        .dicas li b {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #DCDDDF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 12px
        }

        .dicas li strong {
            display: block;
            font-size: 13.5px
        }

        .dicas li span {
            color: #6B7280;
            font-size: 12.5px
        }

        @media(max-width:640px) {
            .infos {
                grid-template-columns: 1fr 1fr
            }

            .visual,
            .progresso {
                flex-direction: column;
                align-items: stretch
            }

            .intro h1 {
                font-size: 1.3rem
            }
        }
    </style>
</head>

<body>
    <aside class="menu">
        <img src="imagem/logo.png" class="logo" alt="Primeiro Passo">
        <nav>
            <ul>
                <li><a href="dashboard.php"><i class="bi bi-house-door"></i><span>Início</span></a></li>
                <li><a href="vagas.php"><i class="bi bi-briefcase"></i><span>Vagas</span></a></li>
                <li><a href="curriculo.php" class="ativo"><i class="bi bi-file-earmark-text-fill"></i><span>Meu
                            Currículo</span></a></li>
                <li><a href="candidaturas.php"><i class="bi bi-send"></i><span>Minhas Candidaturas</span></a></li>
                <li><a href="dicas.php"><i class="bi bi-lightbulb"></i><span>Dicas e Aprendizados</span></a></li>
                <li><a href="perfil.php"><i class="bi bi-person-circle"></i><span>Perfil</span></a></li>
            </ul>
        </nav>
    </aside>

    <div class="pagina">
        <header class="topo">
            <form class="busca" action="vagas.php" method="get" role="search">
                <i class="bi bi-search"></i>
                <input type="search" name="q" placeholder="Buscar vagas, cargos ou empresas...">
            </form>
            <a href="#" class="sino" aria-label="Notificações"><i class="bi bi-bell"></i></a>
            <details class="usuario">
                <summary><i
                        class="bi bi-person-circle"></i><span><?= htmlspecialchars(explode(' ', $_SESSION['nome'])[0]) ?></span><i
                        class="bi bi-caret-down-fill" style="font-size:12px"></i></summary>
                <div class="sub">
                    <a href="perfil.php">Meu perfil</a>
                    <a href="inc/logout.php" class="btn-sair">
                        <i class="bi bi-box-arrow-right"></i>
                        Sair
                    </a>
                </div>
            </details>
        </header>

        <main class="conteudo">
            <div class="grade">
                <div class="col-esq">

                    <section class="card intro">
                        <small>MEU CURRÍCULO</small>
                        <h1>Mostre o seu potencial para as empresas!</h1>
                        <p>Mantenha seu currículo sempre atualizado. Assim, você aumenta suas chances de ser encontrado
                            e conquistar novas oportunidades.</p>
                    </section>

                    <section class="card progresso">
                        <div class="rosca" style="--p:100"><span>100%</span></div>
                        <div>
                            <h3>Seu currículo está 100% completo</h3>
                            <p>Complete as informações para aumentar suas chances de ser contratado.</p>
                            <div class="barra">
                                <div></div>
                            </div>
                        </div>
                    </section>

                    <section class="card">
                        <div class="cab">
                            <h2><i class="bi bi-file-earmark-person"></i>Informações do currículo</h2>
                            <a href="#" class="btn vazado"><i class="bi bi-pencil"></i> Editar currículo</a>
                        </div>
                        <p style="font-size:13px;color:#6B7280;margin:-6px 0 14px">Veja os dados que já foram
                            preenchidos e edite quando precisar.</p>
                        <div class="infos">
                            <a href="#" class="info"><i class="bi bi-check-circle-fill ok"></i>
                                <div class="ic"><i class="bi bi-person-vcard"></i></div>
                                <h4>Dados Pessoais</h4>
                                <p>Nome, data de nascimento, telefone, e-mail e endereço.</p>
                            </a>
                            <a href="#" class="info"><i class="bi bi-check-circle-fill ok"></i>
                                <div class="ic"><i class="bi bi-mortarboard"></i></div>
                                <h4>Escolaridade</h4>
                                <p>Seus cursos e instituições de ensino.</p>
                            </a>
                            <a href="#" class="info"><i class="bi bi-check-circle-fill ok"></i>
                                <div class="ic"><i class="bi bi-briefcase"></i></div>
                                <h4>Experiências</h4>
                                <p>Trabalhos e estágios anteriores.</p>
                            </a>
                            <a href="#" class="info"><i class="bi bi-check-circle-fill ok"></i>
                                <div class="ic"><i class="bi bi-award"></i></div>
                                <h4>Cursos e Certificações</h4>
                                <p>Cursos extras e certificados.</p>
                            </a>
                            <a href="#" class="info"><i class="bi bi-check-circle-fill ok"></i>
                                <div class="ic"><i class="bi bi-stars"></i></div>
                                <h4>Habilidades</h4>
                                <p>Suas principais competências.</p>
                            </a>
                            <a href="#" class="info"><i class="bi bi-check-circle-fill ok"></i>
                                <div class="ic"><i class="bi bi-bullseye"></i></div>
                                <h4>Objetivos</h4>
                                <p>Explique seus objetivos profissionais.</p>
                            </a>
                        </div>
                    </section>

                    <section class="card">
                        <div class="cab">
                            <h2><i class="bi bi-eye"></i>Visualização do currículo</h2>
                            <a href="#" class="btn vazado">Ver currículo completo</a>
                        </div>
                        <p style="font-size:13px;color:#6B7280;margin:-6px 0 14px">Veja como o seu currículo ficará para
                            as empresas.
                        </p>
                        <div class="folha">
                            <div class="foto"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <h4>Nome Aluno</h4>
                                <div class="cargo">Estudante</div>
                                <div class="ct">
                                    <span><i class="bi bi-geo-alt"></i>Itanhaém - SP</span>
                                    <span><i class="bi bi-telephone"></i>(00) 00000-0000</span>
                                    <span><i class="bi bi-envelope"></i>exemplo@gmail.com</span>
                                </div>
                                <p>Em busca da primeira oportunidade de trabalho, onde possa aplicar meus conhecimentos,
                                    aprender e contribuir com a equipe.</p>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-dir">
                    <section class="card dicas">
                        <h3><i class="bi bi-lightbulb"></i>Dicas para um bom currículo</h3>
                        <ol>
                            <li><b>1</b>
                                <div><strong>Seja objetivo</strong><span>Vá direto ao ponto e destaque suas principais
                                        qualificações.</span></div>
                            </li>
                            <li><b>2</b>
                                <div><strong>Use palavras-chave</strong><span>Elas ajudam seu currículo a ser encontrado
                                        pelos
                                        recrutadores.</span></div>
                            </li>
                            <li><b>3</b>
                                <div><strong>Mantenha a atualização</strong><span>Inclua novos cursos, experiências e
                                        habilidades.</span></div>
                            </li>
                            <li><b>4</b>
                                <div><strong>Evite erros de português</strong><span>Revise seu texto antes de
                                        salvar.</span></div>
                            </li>
                        </ol>
                    </section>

                    <section class="card acesso">
                        <h3>Acesso rápido</h3>
                        <div class="atalhos">
                            <a href="#" class="atalho">
                                <div class="circ"><i class="bi bi-file-earmark-person"></i></div>
                                <h4>Editar Currículo</h4>
                                <p>Edite e mantenha seu currículo atualizado</p>
                            </a>
                            <a href="perfil.php" class="atalho">
                                <div class="circ"><i class="bi bi-person-gear"></i></div>
                                <h4>Editar Perfil</h4>
                                <p>Edite e mantenha seu perfil atualizado</p>
                            </a>
                            <a href="dicas.php" class="atalho">
                                <div class="circ"><i class="bi bi-people"></i></div>
                                <h4>Dicas de Entrevista</h4>
                                <p>Prepare-se para se destacar</p>
                            </a>
                            <a href="#" class="atalho">
                                <div class="circ"><i class="bi bi-gear"></i></div>
                                <h4>Configuração</h4>
                                <p>Personalize sua experiência</p>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <footer class="rodape">
            <hr>
            <p>© 2026 Primeiro Passo · Todos os direitos reservados</p>
        </footer>
    </div>
</body>

</html>