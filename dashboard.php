<?php
session_start();

if(!isset($_SESSION['login'])){
header('location:index.php');
}else if($_SESSION['login']!=true){
header('location:index.php');
}

//verificar dados do usuario parzza exibir dinamicamente nome na sesao e outros dados se precisar

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Primeiro Passo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
            font-optical-sizing: auto;
            font-size: 15px
        }
        
        a {
            text-decoration: none;
            color: inherit
        }
        
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
            height: 40px
        }
        
        .busca i {
            color: #6B7280;
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
            color: #1F2937;
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
        
        .ver-todas {
            color: #1A80D5;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap
        }
        
        .ver-todas:hover {
            color: #1A80D5
        }
        
        .cab {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px
        }
        
        .boas h1 {
            font-size: 1.7rem;
            font-weight: 600
        }
        
        .boas h1 span {
            color: #1A80D5
        }
        
        .boas h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin: 6px 0
        }
        
        .boas p {
            color: #6B7280;
            ;
            max-width: 430px
        }
        
        .titulo-bloco {
            font-size: 1.5rem;
            font-weight: 600
        }
        
        .areas {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px
        }
        
        .area {
            text-align: center;
            padding: 18px 12px
        }
        
        .area .ico {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 22px;
            border: 1.5px solid
        }
        
        .ico.azul {
            color: #1A80D5;
            background: #E8F2FC;
            border-color: #1A80D5
        }
        
        .ico.roxo {
            color: #5B4BC4;
            background: #EEEBFA;
            border-color: #5B4BC4
        }
        
        .ico.verde {
            color: #22A05A;
            background: #E6F6EC;
            border-color: #22A05A
        }
        
        .area h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px
        }
        
        .area p {
            color: #6B7280;
            ;
            font-size: 12.5px;
            font-weight: 350
        }
        
        .area:hover {
            border-color: #1A80D5
        }
        
        .vaga {
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid #DDE3EC;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
            padding: 14px 16px;
            margin-bottom: 16px
        }
        
        .vaga:last-child {
            margin-bottom: 0
        }
        
        .logo-emp {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0
        }
        
        .vaga .info {
            flex: 1;
            min-width: 0
        }
        
        .vaga h4 {
            font-size: 1rem;
            font-weight: 600
        }
        
        .vaga .emp {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            margin: 6px 0
        }
        
        .vaga .emp i {
            color: #1F2937
        }
        
        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px 16px;
            color: #6B7280;
            ;
            font-size: 12px
        }
        
        .meta i {
            margin-right: 5px
        }
        
        .vaga .lado {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 14px;
            flex-shrink: 0
        }
        
        .vaga .data {
            font-size: 12.5px
        }
        
        .btn-cand {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #1A80D5;
            color: #fff;
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600
        }
        
        .btn-cand:hover {
            background: #176eb5;
            color: #fff
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
        
        .perfil-card h3 i {
            color: #1A80D5
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
            background: conic-gradient(#1A80D5 calc(100*1%), #E5E7EB 0);
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
            font-weight: 700;
            font-size: 1rem
        }
        
        .perfil-corpo h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px
        }
        
        .perfil-corpo p {
            font-size: 12px;
            color: #6B7280;
            ;
            font-weight: 350
        }
        
        .acesso h3,
        .dicas h3 {
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
            border: 2px solid#1A80D5;
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
            ;
            font-weight: 350
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
            align-items: center;
            font-size: 13px
        }
        
        .dicas li b {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #DCDDDF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
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
        /* RESPONSIVO */
        
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
                padding: 10px 0;
                border-radius: 6px
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
            .areas {
                grid-template-columns: 1fr
            }
            .vaga {
                flex-wrap: wrap
            }
            .vaga .lado {
                flex-direction: row-reverse;
                justify-content: space-between;
                align-items: center;
                width: 100%
            }
            .boas h1 {
                font-size: 1.4rem
            }
            .rodape {
                padding: 0 16px 20px
            }
        }
    </style>
</head>

<body>
    <!--
=====================================================================
 TELA INICIAL DO ALUNO - GUIA DE INTEGRAÇÃO PHP / BANCO DE DADOS
 Tudo que vem do banco está marcado com "PHP/BD:" nos comentários.
 Ao converter para .php, troque o texto fixo pelo  indicado.

 Sugestão de consultas (ajuste aos nomes das suas tabelas):
 1) $aluno     -> SELECT id, nome, foto FROM alunos WHERE id = :id_da_sessao
 2) $perfil    -> % de preenchimento do currículo (calculado em PHP
                  a partir dos campos preenchidos, ou coluna própria)
 3) $vagas     -> SELECT v.id, v.titulo, v.tipo, v.cidade, v.uf,
                         v.modalidade, v.criada_em, e.nome_fantasia, e.logo
                  FROM vagas v JOIN empresas e ON e.id = v.empresa_id
                  WHERE v.ativa = 1
                  ORDER BY v.criada_em DESC LIMIT 3
                  (opcional: filtrar pelas preferências/área do aluno)
 4) $dicas     -> SELECT texto FROM dicas ORDER BY ordem LIMIT 3
                  (ou deixar fixo no HTML, se não precisar vir do banco)
 Proteja a página com session_start() e redirecione para o login se
 não houver aluno logado. Use htmlspecialchars() em todo texto do banco.
=====================================================================
-->


    <aside class="menu">
        <img src="logo.png" class="logo" alt="Primeiro Passo">
        <nav>
            <ul>
                <li><a href="#" class="ativo"><i class="bi bi-house-door-fill"></i><span>Início</span></a></li>
                <li><a href="vagas.html"><i class="bi bi-briefcase"></i><span>Vagas</span></a></li>
                <li><a href="curriculo.html"><i class="bi bi-file-earmark-text"></i><span>Meu Currículo</span></a></li>
                <li><a href="candidaturas.html"><i class="bi bi-send"></i><span>Minhas Candidaturas</span></a></li>
                <li><a href="dicas.html"><i class="bi bi-lightbulb"></i><span>Dicas e Aprendizados</span></a></li>
                <li><a href="perfil.html"><i class="bi bi-person-circle"></i><span>Perfil</span></a></li>
            </ul>
        </nav>
    </aside>

    <div class="pagina">

        <!-- TOPO: busca, notificações e usuário -->
        <header class="topo">
            <!-- A busca envia para vagas.php?q=... ; lá o PHP faz: WHERE titulo LIKE :q OR empresa LIKE :q -->
            <form class="busca" action="vagas.php" method="get" role="search">
                <i class="bi bi-search"></i>
                <input type="search" name="q" placeholder="Buscar vagas, cargos ou empresas...">
            </form>

            <!-- PHP/BD: se houver notificações não lidas, mostrar um selo (ex.: COUNT na tabela notificacoes) -->
            <a href="notificacoes.php" class="sino" aria-label="Notificações"><i class="bi bi-bell"></i></a>

            <details class="usuario">
                <summary>
                    <!-- PHP/BD: foto do aluno (alunos.foto). Sem foto, mantém o ícone padrão abaixo -->
                    <i class="bi bi-person-circle"></i>
                    <!-- PHP/BD: nome do aluno -> <?= htmlspecialchars($aluno['nome']) ?> -->
                    <span>Usuário</span>
                    <i class="bi bi-caret-down-fill" style="font-size:12px"></i>
                </summary>
                <div class="sub">
                    <a href="perfil.php">Meu perfil</a>
                    <!-- logout.php deve fazer session_destroy() e redirecionar para o login -->
                    <a href="logout.php">Sair</a>
                </div>
            </details>
        </header>

        <main class="conteudo">
            <div class="grade">

                <!-- ===== COLUNA ESQUERDA ===== -->
                <div class="col-esq">

                    <!-- BOAS-VINDAS -->
                    <section class="card boas">
                        <!-- PHP/BD: primeiro nome do aluno -> <?= htmlspecialchars(explode(' ', $aluno['nome'])[0]) ?> -->
                        <h1>Olá, <span>Usuário</span>!</h1>
                        <h3>Pronto para dar o próximo passo?</h3>
                        <p>Aqui você encontra vagas, pode montar seu currículo, acompanhar suas candidaturas e acessar conteúdos que vão te ajudar a conquistar suas metas.</p>
                    </section>

                    <!-- EXPLORE POR ÁREA -->
                    <section>
                        <div class="cab">
                            <h2 class="titulo-bloco">Explore por área</h2>
                            <a href="vagas.php" class="ver-todas">Ver todas <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <!-- As 3 áreas são fixas. Cada link filtra as vagas pelo tipo.
               PHP/BD: em vagas.php, usar $_GET['tipo'] (primeiro_emprego | estagio | jovem_aprendiz)
               -> WHERE v.tipo = :tipo. Se quiser, trazer de uma tabela "tipos_vaga". -->
                        <div class="areas">
                            <a href="vagas.php?tipo=primeiro_emprego" class="card area">
                                <div class="ico azul"><i class="bi bi-rocket-takeoff"></i></div>
                                <h4>Primeiro Emprego</h4>
                                <p>Seu primeiro passo no mercado de trabalho.</p>
                            </a>
                            <a href="vagas.php?tipo=estagio" class="card area">
                                <div class="ico roxo"><i class="bi bi-mortarboard-fill"></i></div>
                                <h4>Estágio</h4>
                                <p>Ganhe experiência e construa seu futuro.</p>
                            </a>
                            <a href="vagas.php?tipo=jovem_aprendiz" class="card area">
                                <div class="ico verde"><i class="bi bi-person"></i></div>
                                <h4>Jovem Aprendiz</h4>
                                <p>Trabalhe e estude ao mesmo tempo.</p>
                            </a>
                        </div>
                    </section>

                    <!-- VAGAS RECOMENDADAS -->
                    <section class="card">
                        <div class="cab">
                            <h2 style="font-size:1.1rem;font-weight:600;display:flex;align-items:center;gap:10px"><i class="bi bi-bullseye" style="color:#1A80D5"></i>Vagas recomendadas para você</h2>
                            <a href="vagas.php" class="ver-todas">Ver todas <i class="bi bi-arrow-right"></i></a>
                        </div>

                        <!-- PHP/BD: repetir este bloco <article class="vaga"> com um foreach ($vagas as $v).
               Os 3 abaixo são só exemplos do layout. Campos usados em cada vaga:
               - logo da empresa: $v['logo'] (imagem) ou iniciais + cor de fundo se não houver logo
               - título:          $v['titulo']
               - empresa:         $v['nome_fantasia']
               - tipo:            $v['tipo']  (Estágio / Jovem Aprendiz / Primeiro Emprego)
               - local:           $v['cidade'] . ' - ' . $v['uf']
               - modalidade:      $v['modalidade'] (Presencial / Híbrido / Remoto)
               - "Há X dias":     calcular em PHP a partir de $v['criada_em'] (ex.: DateTime::diff)
               - botão:           candidatar.php?vaga=<?= $v['id'] ?> (grava em candidaturas: aluno_id, vaga_id, data)
               Se o aluno já se candidatou, trocar o botão por "Candidatado" (desabilitado). -->

                        <article class="vaga">
                            <div class="logo-emp" style="background:#1F2937">TS</div>
                            <!-- PHP/BD: logo/iniciais da empresa -->
                            <div class="info">
                                <h4>Estágio em Desenvolvimento Web</h4>
                                <!-- PHP/BD: titulo -->
                                <div class="emp"><i class="bi bi-patch-check-fill"></i>Tech Solutions</div>
                                <!-- PHP/BD: empresa -->
                                <div class="meta">
                                    <span><i class="bi bi-briefcase"></i>Estágio</span>
                                    <!-- PHP/BD: tipo -->
                                    <span><i class="bi bi-geo-alt"></i>Itanhaém - SP</span>
                                    <!-- PHP/BD: cidade - uf -->
                                    <span><i class="bi bi-building"></i>Presencial</span>
                                    <!-- PHP/BD: modalidade -->
                                </div>
                            </div>
                            <div class="lado">
                                <span class="data">Há 2 dias</span>
                                <!-- PHP/BD: tempo desde criada_em -->
                                <a href="candidatar.php?vaga=1" class="btn-cand">Candidatar-se <i
                    class="bi bi-arrow-right"></i></a>
                                <!-- PHP/BD: id da vaga -->
                            </div>
                        </article>

                        <article class="vaga">
                            <div class="logo-emp" style="background:#E23B3B"><i class="bi bi-cart"></i></div>
                            <div class="info">
                                <h4>Supermercado Ideal - Jovem Aprendiz</h4>
                                <div class="emp"><i class="bi bi-patch-check-fill"></i>Supermercado Ideal</div>
                                <div class="meta">
                                    <span><i class="bi bi-briefcase"></i>Jovem Aprendiz</span>
                                    <span><i class="bi bi-geo-alt"></i>Praia Grande - SP</span>
                                    <span><i class="bi bi-building"></i>Presencial</span>
                                </div>
                            </div>
                            <div class="lado">
                                <span class="data">Há 1 semana</span>
                                <a href="candidatar.php?vaga=2" class="btn-cand">Candidatar-se <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="vaga">
                            <div class="logo-emp" style="background:#1B2A4A"><i class="bi bi-buildings"></i></div>
                            <div class="info">
                                <h4>Construtora Horizonte - Auxiliar de Produção</h4>
                                <div class="emp"><i class="bi bi-patch-check-fill"></i>Construtora Horizonte</div>
                                <div class="meta">
                                    <span><i class="bi bi-briefcase"></i>Primeiro Emprego</span>
                                    <span><i class="bi bi-geo-alt"></i>Itanhaém - SP</span>
                                    <span><i class="bi bi-building"></i>Presencial</span>
                                </div>
                            </div>
                            <div class="lado">
                                <span class="data">Há 1 mês</span>
                                <a href="candidatar.php?vaga=3" class="btn-cand">Candidatar-se <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- PHP/BD: se $vagas estiver vazio, mostrar: "Ainda não há vagas para o seu perfil." -->
                    </section>
                </div>

                <!-- ===== COLUNA DIREITA ===== -->
                <div class="col-dir">

                    <!-- SEU PERFIL -->
                    <section class="card perfil-card">
                        <h3><i class="bi bi-graph-up-arrow"></i>Seu perfil</h3>
                        <div class="perfil-corpo">
                            <!-- PHP/BD: porcentagem do currículo. Troque o 100 em --p e no texto:
                 style="--p:<?= (int)$perfil ?>"  e  <?= (int)$perfil ?>%  (a rosca desenha sozinha via CSS) -->
                            <div class="rosca" style="--p:100"><span>100%</span></div>
                            <div>
                                <!-- PHP/BD: se $perfil < 100, trocar por "Seu currículo está X% completo" -->
                                <h4>Seu currículo está 100% completo</h4>
                                <p>Complete as informações para aumentar suas chances de ser contratado.</p>
                            </div>
                        </div>
                    </section>

                    <!-- ACESSO RÁPIDO (links fixos, sem banco) -->
                    <section class="card acesso">
                        <h3>Acesso rápido</h3>
                        <div class="atalhos">
                            <a href="curriculo.php" class="atalho">
                                <div class="circ"><i class="bi bi-file-earmark-person"></i></div>
                                <h4>Editar Currículo</h4>
                                <p>Edite e mantenha seu currículo atualizado</p>
                            </a>
                            <a href="perfil.php" class="atalho">
                                <div class="circ"><i class="bi bi-person-gear"></i></div>
                                <h4>Editar Perfil</h4>
                                <p>Edite e mantenha seu perfil atualizado</p>
                            </a>
                            <a href="dicas.php?tema=entrevista" class="atalho">
                                <div class="circ"><i class="bi bi-people"></i></div>
                                <h4>Dicas de Entrevista</h4>
                                <p>Prepare-se para se destacar</p>
                            </a>
                            <a href="configuracoes.php" class="atalho">
                                <div class="circ"><i class="bi bi-gear"></i></div>
                                <h4>Configuração</h4>
                                <p>Personalize sua experiência</p>
                            </a>
                        </div>
                    </section>

                    <!-- DICAS (texto fixo; PHP/BD opcional: foreach ($dicas as $i => $d) com o texto vindo de uma tabela "dicas") -->
                    <section class="card dicas">
                        <h3>Dicas para aumentar suas chances</h3>
                        <ol>
                            <li><b>1</b><span>Mantenha seu currículo sempre atualizado com suas novas experiências.</span></li>
                            <li><b>2</b><span>Personalize sua carta de apresentação para cada vaga.</span></li>
                            <li><b>3</b><span>Participe de processos seletivos e entrevistas, mesmo que não se sinta 100%
                  preparado.</span></li>
                        </ol>
                    </section>
                </div>
            </div>
        </main>

        <footer class="rodape">
            <hr>
            <p>© 2026 Primeiro Passo - Todos os direitos reservados.</p>
        </footer>
    </div>
</body>

</html>