<?php

include_once('inc/config.php');

include_once('inc/verificacao_login.php');
if($_SESSION['tipo']=="empresa"){
include_once('inc/empresa/buscar_vagas.php');
}

//verificar dados do usuario parzza exibir dinamicamente nome na sesao e outros dados se precisar

?>
<?php if (($_SESSION['tipo'] ?? '') == 'empresa'): ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Vagas - Primeiro Passo Empresa
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
        <link href="css/vagas/empresa.css" rel="stylesheet" />
    </head>

    <body>
        <aside class="menu">
            <img src="Imagem/logo.png" class="logo" alt="Primeiro Passo Empresas">
            <nav>
                <ul>
                    <li><a href="dashboard.php"><i class="bi bi-house-door-fill"></i><span>Início</span></a></li>
                    <li><a href="vagas.php" class="ativo"><i class="bi bi-briefcase"></i><span>Vagas</span></a></li>
                    <li><a href="candidaturas.php"><i class="bi bi-file-earmark-text"></i><span>Candidaturas</span></a></li>
                    <li><a href="perfil.php"><i class="bi bi-building"></i><span>Meu Perfil</span></a></li>
                    <li><a href="configuracoes.php"><i class="bi bi-gear"></i><span>Configurações</span></a></li>
                </ul>
            </nav>
            <div class="conectando">
                <div class="l1"><i class="bi bi-people-fill"></i>Conectando empresas e talentos.</div>
                <p>Juntos, construímos um futuro melhor.</p>
            </div>
        </aside>
        <div class="pagina">
            <header class="topo">
                <form action="candidaturas_empresa.php" class="busca" method="get" role="search">
                    <i class="bi bi-search">
                    </i>
                    <input name="q" placeholder="Buscar candidatos ou vagas..." type="search" />
                </form>
                <a aria-label="Notificações" class="sino" href="#">
                    <i class="bi bi-bell">
                    </i>
                </a>
                <details class="usuario">
                    <summary>
                       <span class="av-emp"><i class="bi bi-buildings-fill"></i></span>
                        </i>
                        <span>
                            <?= htmlspecialchars($_SESSION['nome_empresa'] ?? $_SESSION['nome'] ?? 'Empresa') ?>
                        </span>
                        <i class="bi bi-caret-down-fill" style="font-size:12px">
                        </i>
                    </summary>
                    <div class="sub">
                        <a href="perfil_empresa.php">
                            Perfil da empresa
                        </a>
                        <a href="configuracoes_empresa.php">
                            Configurações
                        </a>
                        <a href="inc/logout.php">
                            Sair
                        </a>
                    </div>
                </details>
            </header>
            <main class="conteudo">
                <div class="grade">
                    <div class="col-esq">
                        <section class="hero">
                            <div>
                                <h1>
                                    Vagas da Empresa
                                </h1>
                                <p>
                                    Gerencie suas vagas, acompanhe os candidatos e publique novas oportunidades.
                                </p>
                            </div>
                            <a class="btn claro lg2" href="criar_vaga.php">
                                <i class="bi bi-plus-lg">
                                </i>
                                Nova vaga
                            </a>
                        </section>
                        <section class="card">
                            <div class="filtros">
                                <input id="q" placeholder="Buscar vaga..." type="search" />
                                <select id="st">
                                    <option value="">
                                        Todos os status
                                    </option>
                                    <option>
                                        Ativa
                                    </option>
                                    <option>
                                        desativada
                                    </option>
                                    <option>
                                        Encerrada
                                    </option>
                                </select>
                            </div>
                            <div class="tbl-w">
                                <table class="t" id="tb">
                                    <thead>
                                        <tr>
                                            <th>Vaga</th>
                                            <th>Tipo</th>
                                            <th>Local</th>
                                            <th>Publicada em</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($vagas as $vaga): ?>
                                            <tr data-s="<?= htmlspecialchars($vaga['ds_status']) ?>">
                                                <td>
                                                    <b><?= htmlspecialchars($vaga['nm_titulo']) ?></b>
                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($vaga['tipo']) ?>
                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($vaga['nm_cidade'] . ' - ' . $vaga['sg_uf']) ?>
                                                </td>

                                                <td>
                                                    <?= date('d/m/Y', strtotime($vaga['dt_publicacao'])) ?>
                                                </td>

                                                <td>
                                                    <span
                                                        class="bd <?= $vaga['ds_status'] == 'Ativa' ? 'b-verde' : ($vaga['ds_status'] == 'Encerrada' ? 'b-vermelho' : 'b-cinza') ?>">
                                                        <?= htmlspecialchars($vaga['ds_status']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                           <div class="pag" id="paginacao"></div>
                        </section>
                    </div>
                    <div class="col-dir">
                        <section class="card">
                            <h2 class="t2">
                                Resumo das vagas
                            </h2>
                            <ul class="res">
                                <li>
                                    <span class="bd b-verde">
                                        Ativa
                                    </span>
                                    <b>
                                        5
                                    </b>
                                </li>
                                <li>
                                    <span class="bd b-amarelo">
                                        desativada
                                    </span>
                                    <b>
                                        2
                                    </b>
                                </li>
                                <li>
                                    <span class="bd b-cinza">
                                        Encerrada
                                    </span>
                                    <b>
                                        1
                                    </b>
                                </li>
                                <li>
                                    Total
                                    <b>
                                        8
                                    </b>
                                </li>
                            </ul>
                        </section>
                        <section class="card">
                            <h2 class="t2">
                                Dica
                            </h2>
                            <p style="font-size:13px;color:#6B7280">
                                Vagas com descrição clara e requisitos objetivos recebem mais candidaturas de qualidade.
                            </p>
                        </section>
                        <section class="card promo">
                            <i class="bi bi-megaphone">
                            </i>
                            <h3>
                                Publique uma nova vaga
                            </h3>
                            <p>
                                Encontre jovens talentos para a sua equipe.
                            </p>
                            <a class="btn claro" href="criar_vaga.php">
                                Nova vaga
                            </a>
                        </section>
                    </div>
                </div>
            </main>
            <footer class="rodape">
                <hr />
                <p>
                    © 2026 Primeiro Passo · Todos os direitos reservados
                </p>
            </footer>
        </div>
      
        <script>
   let q = document.getElementById('q');
   let s = document.getElementById('st');

   let linhas = Array.from(document.querySelectorAll('#tb tbody tr'));
   let paginacao = document.getElementById('paginacao');

   let paginaAtual = 1;
   let porPagina = 5;

    function mostrarVagas() {

       let filtradas = linhas.filter(function (linha) {

           let busca = linha.textContent.toLowerCase().includes(q.value.toLowerCase());

           let status = !s.value || linha.dataset.s === s.value;

            return busca && status;
        });

       let totalPaginas = Math.ceil(filtradas.length / porPagina);

        if (paginaAtual > totalPaginas) {
            paginaAtual = Math.max(1, totalPaginas);
        }

        linhas.forEach(function (linha) {
            linha.style.display = 'none';
        });

       let inicio = (paginaAtual - 1) * porPagina;
       let fim = inicio + porPagina;

        filtradas.slice(inicio, fim).forEach(function (linha) {
            linha.style.display = '';
        });

        paginacao.innerHTML = '';

        if (totalPaginas <= 1) {
            return;
        }

        function criarBotao(texto, pagina, ativo, desabilitado) {

           let botao = document.createElement('button');

            botao.type = 'button';
            botao.innerHTML = texto;

            if (ativo) {
                botao.classList.add('on');
            }

            botao.disabled = desabilitado;

            botao.addEventListener('click', function () {
                paginaAtual = pagina;
                mostrarVagas();
            });

            paginacao.appendChild(botao);
        }

        criarBotao(
            '<i class="bi bi-chevron-left"></i>',
            paginaAtual - 1,
            false,
            paginaAtual === 1
        );

        for (var i = 1; i <= totalPaginas; i++) {
            criarBotao(i, i, i === paginaAtual, false);
        }

        criarBotao(
            '<i class="bi bi-chevron-right"></i>',
            paginaAtual + 1,
            false,
            paginaAtual === totalPaginas
        );
    }

    q.addEventListener('input', function () {
        paginaAtual = 1;
        mostrarVagas();
    });

    s.addEventListener('change', function () {
        paginaAtual = 1;
        mostrarVagas();
    });

    mostrarVagas();
</script>
    </body>

    </html>
<?php elseif (($_SESSION['tipo'] ?? '') == 'aluno'): ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Vagas - Primeiro Passo
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
        <link href="css/vagas/aluno.css" rel="stylesheet" />
    </head>

    <body>
        <aside class="menu">
            <img alt="Primeiro Passo" class="logo" src="imagem/logo.png" />
            <nav>
                <ul>
                    <li>
                        <a href="dashboard.php">
                            <i class="bi bi-house-door">
                            </i>
                            <span>
                                Início
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="ativo" href="#">
                            <i class="bi bi-briefcase-fill">
                            </i>
                            <span>
                                Vagas
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="curriculo.php">
                            <i class="bi bi-file-earmark-text">
                            </i>
                            <span>
                                Meu Currículo
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="candidaturas.php">
                            <i class="bi bi-send">
                            </i>
                            <span>
                                Minhas Candidaturas
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="dicas.php">
                            <i class="bi bi-lightbulb">
                            </i>
                            <span>
                                Dicas e Aprendizados
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="perfil.php">
                            <i class="bi bi-person-circle">
                            </i>
                            <span>
                                Perfil
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="pagina">
            <header class="topo">
                <form action="vagas.php" class="busca" method="get" role="search">
                    <i class="bi bi-search">
                    </i>
                    <input name="q" placeholder="Buscar vagas, cargos ou empresas..." type="search" />
                </form>
                <a aria-label="Notificações" class="sino" href="#">
                    <i class="bi bi-bell">
                    </i>
                </a>
                <details class="usuario">
                    <summary>
                        <i class="bi bi-person-circle">
                        </i>
                        <span>
                            <?= htmlspecialchars(explode(' ', $_SESSION['nome'])[0]) ?>
                        </span>
                        <i class="bi bi-caret-down-fill" style="font-size:12px">
                        </i>
                    </summary>
                    <div class="sub">
                        <a href="perfil.php">
                            Meu perfil
                        </a>
                        <a class="btn-sair" href="inc/logout.php">
                            <i class="bi bi-box-arrow-right">
                            </i>
                            Sair
                        </a>
                    </div>
                </details>
            </header>
            <main class="conteudo">
                <div class="grade">
                    <div class="col-esq">
                        <section class="destaque">
                            <small>
                                Destaque do dia
                            </small>
                            <h1>
                                Encontre a oportunidade ideal para o seu futuro!
                            </h1>
                            <p>
                                Aqui você encontra vagas de estágio, jovem aprendiz e primeiro emprego pensadas para quem
                                está começando.
                            </p>
                        </section>
                        <section class="card">
                            <div class="cab">
                                <h2>
                                    <i class="bi bi-bullseye">
                                    </i>
                                    Vagas recomendadas para você
                                </h2>
                                <a class="ver-todas" href="#">
                                    Ver todas
                                    <i class="bi bi-arrow-right">
                                    </i>
                                </a>
                            </div>
                            <div class="carrossel">
                                <button aria-label="Anterior" class="seta" data-dir="-1">
                                    <i class="bi bi-chevron-left">
                                    </i>
                                </button>
                                <div class="trilho">
                                    <article class="vaga">
                                        <div class="logo-emp" style="background:#E23B3B">
                                            <i class="bi bi-cart">
                                            </i>
                                        </div>
                                        <div>
                                            <h4>
                                                Jovem Aprendiz - Atendimento
                                            </h4>
                                            <div class="emp">
                                                Supermercado Ideal
                                            </div>
                                            <div class="meta">
                                                <span>
                                                    <i class="bi bi-geo-alt">
                                                    </i>
                                                    Praia Grande -
                                                    SP
                                                </span>
                                                <span>
                                                    <i class="bi bi-building">
                                                    </i>
                                                    Presencial
                                                </span>
                                            </div>
                                            <a class="btn" href="#">
                                                Candidatar-se
                                                <i class="bi bi-arrow-right">
                                                </i>
                                            </a>
                                        </div>
                                    </article>
                                    <article class="vaga">
                                        <div class="logo-emp" style="background:#1F2937">
                                            TS
                                        </div>
                                        <div>
                                            <h4>
                                                Estágio em Desenvolvimento Web
                                            </h4>
                                            <div class="emp">
                                                Tech Solutions
                                            </div>
                                            <div class="meta">
                                                <span>
                                                    <i class="bi bi-geo-alt">
                                                    </i>
                                                    Itanhaém -
                                                    SP
                                                </span>
                                                <span>
                                                    <i class="bi bi-building">
                                                    </i>
                                                    Híbrido
                                                </span>
                                            </div>
                                            <a class="btn" href="#">
                                                Candidatar-se
                                                <i class="bi bi-arrow-right">
                                                </i>
                                            </a>
                                        </div>
                                    </article>
                                    <article class="vaga">
                                        <div class="logo-emp" style="background:#1B2A4A">
                                            <i class="bi bi-buildings">
                                            </i>
                                        </div>
                                        <div>
                                            <h4>
                                                Auxiliar de Produção
                                            </h4>
                                            <div class="emp">
                                                Construtora Horizonte
                                            </div>
                                            <div class="meta">
                                                <span>
                                                    <i class="bi bi-geo-alt">
                                                    </i>
                                                    Itanhaém -
                                                    SP
                                                </span>
                                                <span>
                                                    <i class="bi bi-building">
                                                    </i>
                                                    Presencial
                                                </span>
                                            </div>
                                            <a class="btn" href="#">
                                                Candidatar-se
                                                <i class="bi bi-arrow-right">
                                                </i>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                <button aria-label="Próxima" class="seta" data-dir="1">
                                    <i class="bi bi-chevron-right">
                                    </i>
                                </button>
                            </div>
                        </section>
                        <section class="card">
                            <div class="cab">
                                <h2>
                                    <i class="bi bi-star-fill">
                                    </i>
                                    Estágios em destaque
                                </h2>
                                <a class="ver-todas" href="#">
                                    Ver todas
                                    <i class="bi bi-arrow-right">
                                    </i>
                                </a>
                            </div>
                            <div class="carrossel">
                                <button aria-label="Anterior" class="seta" data-dir="-1">
                                    <i class="bi bi-chevron-left">
                                    </i>
                                </button>
                                <div class="trilho">
                                    <article class="estagio">
                                        <h4>
                                            Estágio em Administração
                                        </h4>
                                        <p>
                                            Logística Express · Itanhaém - SP
                                        </p>
                                        <a class="btn" href="#">
                                            Candidatar-se
                                        </a>
                                    </article>
                                    <article class="estagio b">
                                        <h4>
                                            Estágio em Logística
                                        </h4>
                                        <p>
                                            Porto Sul · Santos - SP
                                        </p>
                                        <a class="btn" href="#">
                                            Candidatar-se
                                        </a>
                                    </article>
                                    <article class="estagio">
                                        <h4>
                                            Estágio em Marketing
                                        </h4>
                                        <p>
                                            Agência Onda · Peruíbe - SP
                                        </p>
                                        <a class="btn" href="#">
                                            Candidatar-se
                                        </a>
                                    </article>
                                </div>
                                <button aria-label="Próxima" class="seta" data-dir="1">
                                    <i class="bi bi-chevron-right">
                                    </i>
                                </button>
                            </div>
                        </section>
                        <section class="card">
                            <div class="cab">
                                <h2>
                                    <i class="bi bi-grid-fill">
                                    </i>
                                    Vagas por categorias
                                </h2>
                            </div>
                            <div class="carrossel">
                                <div class="cats">
                                    <a class="cat" href="#" style="background:#4A9BE8">
                                        <i class="bi bi-cpu">
                                        </i>
                                        <h4>
                                            Tecnologia & TI
                                        </h4>
                                        <small>
                                            48 vagas
                                        </small>
                                        <span class="btn">
                                            Ver
                                            vagas
                                        </span>
                                    </a>
                                    <a class="cat" href="#" style="background:#3DBE6B">
                                        <i class="bi bi-file-earmark-text">
                                        </i>
                                        <h4>
                                            Administração
                                        </h4>
                                        <small>
                                            35 vagas
                                        </small>
                                        <span class="btn">
                                            Ver vagas
                                        </span>
                                    </a>
                                    <a class="cat" href="#" style="background:#E23B3B">
                                        <i class="bi bi-cart3">
                                        </i>
                                        <h4>
                                            Vendas & Atendimento
                                        </h4>
                                        <small>
                                            52 vagas
                                        </small>
                                        <span class="btn">
                                            Ver
                                            vagas
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-dir">
                        <section class="card perfil-card">
                            <h3>
                                <i class="bi bi-graph-up-arrow">
                                </i>
                                Seu perfil
                            </h3>
                            <div class="perfil-corpo">
                                <div class="rosca" style="--p:100">
                                    <span>
                                        100%
                                    </span>
                                </div>
                                <div>
                                    <h4>
                                        Seu currículo está 100% completo
                                    </h4>
                                    <p>
                                        Currículos com informações completas aumentam suas chances de ser contratado.
                                    </p>
                                </div>
                            </div>
                        </section>
                        <section class="card acesso">
                            <h3>
                                Acesso rápido
                            </h3>
                            <div class="atalhos">
                                <a class="atalho" href="curriculo.php">
                                    <div class="circ">
                                        <i class="bi bi-file-earmark-person">
                                        </i>
                                    </div>
                                    <h4>
                                        Editar Currículo
                                    </h4>
                                    <p>
                                        Mantenha seu currículo atualizado
                                    </p>
                                </a>
                                <a class="atalho" href="perfil.php">
                                    <div class="circ">
                                        <i class="bi bi-person-gear">
                                        </i>
                                    </div>
                                    <h4>
                                        Editar Perfil
                                    </h4>
                                    <p>
                                        Mantenha seu perfil atualizado
                                    </p>
                                </a>
                                <a class="atalho" href="dicas.php">
                                    <div class="circ">
                                        <i class="bi bi-people">
                                        </i>
                                    </div>
                                    <h4>
                                        Dicas de Entrevista
                                    </h4>
                                    <p>
                                        Prepare-se para se destacar
                                    </p>
                                </a>
                                <a class="atalho" href="#">
                                    <div class="circ">
                                        <i class="bi bi-gear">
                                        </i>
                                    </div>
                                    <h4>
                                        Configuração
                                    </h4>
                                    <p>
                                        Personalize sua experiência
                                    </p>
                                </a>
                            </div>
                        </section>
                        <section class="card alerta">
                            <div class="sino-g">
                                <i class="bi bi-bell">
                                </i>
                            </div>
                            <div>
                                <h3>
                                    Alerta de vagas
                                </h3>
                                <p>
                                    Receber novas vagas por e-mail.
                                </p>
                                <label style="margin:8px 0 0;font-size:12px;display:flex;gap:6px;align-items:center">
                                    <input checked="" type="checkbox" />
                                    Ativar alerta
                                </label>
                            </div>
                        </section>
                        <section class="card">
                            <h3 style="font-size:1.05rem;font-weight:600;text-align:center;margin-bottom:14px">
                                Empresas em
                                destaque
                            </h3>
                            <div class="empresas">
                                <div>
                                    <div class="l" style="background:#E23B3B">
                                        <i class="bi bi-cart">
                                        </i>
                                    </div>
                                    Supermercado
                                    Ideal
                                </div>
                                <div>
                                    <div class="l" style="background:#1F2937">
                                        TS
                                    </div>
                                    Tech Solutions
                                </div>
                                <div>
                                    <div class="l" style="background:#C0392B">
                                        <i class="bi bi-heart-pulse">
                                        </i>
                                    </div>
                                    Clínica
                                    Vida
                                </div>
                                <div>
                                    <div class="l" style="background:#1B2A4A">
                                        <i class="bi bi-buildings">
                                        </i>
                                    </div>
                                    Construtora
                                </div>
                                <div>
                                    <div class="l" style="background:#22A05A">
                                        <i class="bi bi-flower1">
                                        </i>
                                    </div>
                                    Floricultura
                                </div>
                                <div>
                                    <div class="l" style="background:#5B4BC4">
                                        <i class="bi bi-truck">
                                        </i>
                                    </div>
                                    Logística
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
            <footer class="rodape">
                <hr />
                <p>
                    © 2026 Primeiro Passo · Todos os direitos reservados
                </p>
            </footer>
        </div>
        <script>
            document.querySelectorAll('.carrossel').forEach(function (c) {
               let t = c.querySelector('.trilho');
                if (!t) return;
                c.querySelectorAll('.seta').forEach(function (b) {
                    b.addEventListener('click', function () {
                        t.scrollBy({
                            left: b.dataset.dir * (t.clientWidth * 0.9)
                        })
                    });
                });
            });
        </script>
    </body>

    </html>
<?php else: ?>
    <p>Tipo de conta sem acesso à página de vagas.</p>
<?php endif; ?>