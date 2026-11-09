<?php
include_once("inc/config.php");

include_once('inc/verificacao_login.php');
$usuario = $_SESSION['tipo'];
$cd_usuario = $_SESSION['id_usuario'];
if (!in_array($usuario, ['aluno', 'empresa'], true)) {
    http_response_code(403);
    exit('Tipo de conta sem dashboard configurado.');
}
if ($usuario == 'aluno') {

    $pesquisa = $conexao->prepare("SELECT a.cd_aluno, a.nr_telefone, e.* 
        FROM tb_alunos a
        LEFT JOIN tb_enderecos e ON a.id_endereco = e.cd_endereco
        WHERE a.id_usuario = ?");

    $pesquisa->bind_param("i", $cd_usuario);
    $pesquisa->execute();

    $dados = $pesquisa->get_result()->fetch_assoc();

    $_SESSION['id_aluno'] = $dados['cd_aluno'] ?? null;
    $_SESSION['telefone'] = $dados['nr_telefone'] ?? '';

    $_SESSION['cep'] = $dados['nr_cep'] ?? '';
    $_SESSION['rua'] = $dados['ds_rua'] ?? '';
    $_SESSION['numero'] = $dados['nr_numero'] ?? '';
    $_SESSION['complemento'] = $dados['ds_complemento'] ?? '';
    $_SESSION['bairro'] = $dados['nm_bairro'] ?? '';
    $_SESSION['cidade'] = $dados['nm_cidade'] ?? '';
    $_SESSION['estado'] = $dados['sg_uf'] ?? '';
    include_once('inc/aluno/buscar_vagas_dashboard.php');



} elseif ($usuario == 'empresa') {

    $pesquisa = $conexao->prepare("SELECT em.cd_empresa, em.nm_fantasia, e.*
        FROM tb_empresas em
        INNER JOIN tb_enderecos e ON em.id_endereco = e.cd_endereco
        WHERE em.id_usuario = ?");

    $pesquisa->bind_param("i", $cd_usuario);
    $pesquisa->execute();

    $dados = $pesquisa->get_result()->fetch_assoc();

    $_SESSION['id_empresa'] = $dados['cd_empresa'] ?? null;
    $_SESSION['nome_empresa'] = $dados['nm_fantasia'] ?? '';

    $_SESSION['cep'] = $dados['nr_cep'] ?? '';
    $_SESSION['rua'] = $dados['ds_rua'] ?? '';
    $_SESSION['numero'] = $dados['nr_numero'] ?? '';
    $_SESSION['complemento'] = $dados['ds_complemento'] ?? '';
    $_SESSION['bairro'] = $dados['nm_bairro'] ?? '';
    $_SESSION['cidade'] = $dados['nm_cidade'] ?? '';
    $_SESSION['estado'] = $dados['sg_uf'] ?? '';


    include_once('inc/empresa/buscar_vaga_dashboard.php');





} //elseif ($usuario == 'administrador') {


//}

?>

<?php if ($usuario == 'empresa'): ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início - Primeiro Passo Empresas</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="css/dashboard/empresa.css">
    </head>

    <body>
        <aside class="menu">
            <img src="Imagem/logo.png" class="logo" alt="Primeiro Passo Empresas">
            <nav>
                <ul>
                    <li><a href="dashboard.php" class="ativo"><i class="bi bi-house-door-fill"></i><span>Início</span></a>
                    </li>
                    <li><a href="vagas.php"><i class="bi bi-briefcase"></i><span>Vagas</span></a></li>
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
                <form class="busca" action="candidaturas.php" method="get" role="search">
                    <i class="bi bi-search"></i>
                    <input type="search" name="q" placeholder="Buscar vagas, candidatos ou áreas de interesse...">
                </form>


                <a href="notificacoes.php" class="sino" aria-label="Notificações">
                    <i class="bi bi-bell"></i>
                </a>

                <details class="usuario">
                    <summary>
                        <span class="av-emp"><i class="bi bi-buildings-fill"></i></span>
                        <span
                            class="nome"><b><?= htmlspecialchars($_SESSION['nome_empresa'] ?? $_SESSION['nome'] ?? 'Empresa') ?></b><small>Empresa</small></span>
                        <i class="bi bi-caret-down-fill" style="font-size:12px"></i>
                    </summary>
                    <div class="sub">
                        <a href="perfil.php">Perfil da empresa</a>
                        <a href="configuracoes.php">Configurações</a>
                        <a href="inc/logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
                    </div>
                </details>
            </header>

            <main class="conteudo">
                <div class="grade">


                    <div class="col-esq">

                        <section class="hero">
                            <div class="ico-emp"><i class="bi bi-buildings"></i></div>
                            <div class="txt">
                                <h1>Olá, <?= htmlspecialchars($_SESSION['nome_empresa'] ?? 'Empresa') ?>!</h1>
                                <p>Gerencie suas vagas e acompanhe seus candidatos.</p>
                            </div>
                            <div class="slogan">Grandes contratações começam aqui!</div>
                        </section>


                        <div class="stats">
                            <div class="card stat">
                                <div class="ic az"><i class="bi bi-briefcase-fill"></i></div>
                                <b><?= htmlspecialchars($totalVagas) ?></b><span>Vagas publicadas</span>

                            </div>
                            <div class="card stat">
                                <div class="ic ro"><i class="bi bi-people-fill"></i></div>
                                <b><b><?= htmlspecialchars($totalCandidaturas) ?></b></b><span>Candidaturas recebidas</span>


                            </div>
                            <div class="card stat">
                                <div class="ic vd"><i class="bi bi-person-fill"></i></div>
                                <b><?= htmlspecialchars($emAnalise) ?></b><span>Candidatos em análise</span>

                            </div>
                            <div class="card stat">
                                <div class="ic la"><i class="bi bi-patch-check-fill"></i></div>
                                <b><?= htmlspecialchars($totalContratacoes) ?></b><span>Contratações realizadas</span>

                            </div>
                        </div>


                        <section class="card">
                            <div class="cab">
                                <h2><i class="bi bi-briefcase-fill"></i>Vagas recentes</h2>
                                <a href="vagas.php" class="ver-todas">Ver todas as vagas <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                            <div class="lista">

                                <?php if (count($vagas) > 0): ?>

                                    <?php foreach ($vagas as $vaga): ?>

                                        <article class="vaga-linha">

                                            <div class="quad" style="background:#0B1F3A">
                                                <i class="bi bi-briefcase"></i>
                                            </div>

                                            <div class="info">

                                                <h4><?= htmlspecialchars($vaga['nm_titulo']) ?></h4>

                                                <div class="meta">
                                                    <span>
                                                        <i class="bi bi-geo-alt"></i>
                                                        <?= htmlspecialchars(($vaga['nm_cidade'] ?? '') . ' - ' . ($vaga['sg_uf'] ?? '')) ?>
                                                    </span>

                                                    <span>
                                                        <i class="bi bi-briefcase"></i>
                                                        <?= htmlspecialchars($vaga['ds_regime_contratacao'] ?? '') ?>
                                                    </span>
                                                </div>

                                            </div>

                                            <span class="bd b-azul">
                                                <?= htmlspecialchars($vaga['ds_status'] ?? '') ?>
                                            </span>

                                        </article>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <p>Nenhuma vaga cadastrada.</p>

                                <?php endif; ?>

                            </div>
                        </section>

                        <section class="card">
                            <div class="cab">
                                <h2><i class="bi bi-people-fill"></i>Candidaturas recentes</h2>
                                <a href="candidaturas.php" class="ver-todas">Ver todas as candidaturas <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                            <div class="tbl-w">
                                <table class="t">
                                    <thead>
                                        <tr>
                                            <th>Candidato</th>
                                            <th>Vaga</th>
                                            <th>Data da candidatura</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($candidaturas as $candidatura): ?>

                                            <tr>
                                                <td>
                                                    <span class="av">
                                                        <?= htmlspecialchars(mb_strtoupper(
                                                            mb_substr($candidatura['nm_aluno'], 0, 1)
                                                        )) ?>
                                                    </span>

                                                    <?= htmlspecialchars($candidatura['nm_aluno']) ?>
                                                </td>

                                                <td class="vaga-col">
                                                    <?= htmlspecialchars($candidatura['nm_titulo']) ?>
                                                </td>

                                                <td>
                                                    <?= date('d/m/Y', strtotime($candidatura['dt_candidatura'])) ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    $status = $candidatura['ds_status'];

                                                    $classe = match ($status) {
                                                        'Em análise' => 'b-azul',
                                                        'Entrevista' => 'b-roxo',
                                                        'Aprovado', 'Contratado' => 'b-verde',
                                                        'Reprovado' => 'b-vermelho',
                                                        default => 'b-azul'
                                                    };
                                                    ?>

                                                    <span class="bd <?= $classe ?>">
                                                        <?= htmlspecialchars($status) ?>
                                                    </span>
                                                </td>

                                                <td>
                                                    <a href="candidaturas.php" class="mais">
                                                        <i class="bi bi-three-dots"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>

                                        <?php if (count($candidaturas) == 0): ?>
                                            <tr>
                                                <td colspan="5">Nenhuma candidatura recebida.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>

                    <!-- ===== COLUNA DIREITA ===== -->
                    <div class="col-dir">

                        <!-- AÇÕES RÁPIDAS (links fixos) -->
                        <section class="card">
                            <div class="cab">
                                <h2><i class="bi bi-lightning-charge-fill"></i>Ações rápidas</h2>
                            </div>
                            <div class="acoes">
                                <a href="vagas.php" class="acao">
                                    <div class="circ"><i class="bi bi-plus-lg"></i></div>
                                    <h4>Publicar vaga</h4>
                                    <p>Crie uma nova oportunidade de emprego</p>
                                    <i class="bi bi-arrow-right seta"></i>
                                </a>
                                <a href="candidaturas.php" class="acao">
                                    <div class="circ"><i class="bi bi-list-check"></i></div>
                                    <h4>Ver candidaturas</h4>
                                    <p>Acesse as candidaturas das suas vagas</p>
                                    <i class="bi bi-arrow-right seta"></i>
                                </a>
                                <a href="perfil.php" class="acao">
                                    <div class="circ"><i class="bi bi-person-fill"></i></div>
                                    <h4>Meu perfil</h4>
                                    <p>Edite as informações da sua empresa</p>
                                    <i class="bi bi-arrow-right seta"></i>
                                </a>
                                <a href="configuracoes.php" class="acao">
                                    <div class="circ"><i class="bi bi-gear-fill"></i></div>
                                    <h4>Configurações</h4>
                                    <p>Gerencie sua conta e preferências</p>
                                    <i class="bi bi-arrow-right seta"></i>
                                </a>
                            </div>
                        </section>

                        <!-- NOTIFICAÇÕES -->
                        <section class="card">
                            <div class="cab">
                                <h2><i class="bi bi-bell"></i>Notificações</h2>
                                <a href="notificacoes.php" class="ver-todas">Ver todas</a>
                            </div>
                            <!-- PHP/BD: foreach nas últimas 3 notificações não lidas -->
                            <ul class="notif">
                                <li>
                                    <span class="pt"></span>
                                    <span class="tx"><b>Nova candidatura na vaga Desenvolvedor Web Júnior</b><small>Gabriel
                                            Souza se candidatou à vaga.</small></span>
                                    <span class="hr">há 12 min</span>
                                </li>
                                <li>
                                    <span class="pt"></span>
                                    <span class="tx"><b>Nova candidatura na vaga Auxiliar de Produção</b><small>Beatriz Lima
                                            se candidatou à vaga.</small></span>
                                    <span class="hr">há 25 min</span>
                                </li>
                                <li>
                                    <span class="pt"></span>
                                    <span class="tx"><b>Sua vaga Estágio em Marketing Digital recebeu 3 novas
                                            candidaturas.</b></span>
                                    <span class="hr">há 1 h</span>
                                </li>
                            </ul>
                        </section>

                        <!-- DIVULGAÇÃO -->
                        <section class="card promo">
                            <div class="topo-p">
                                <i class="bi bi-bullseye"></i>
                                <h3>Encontre os melhores talentos para sua empresa!</h3>
                            </div>
                            <p>Com o Primeiro Passo, você tem acesso a jovens qualificados e prontos para o mercado.</p>
                            <a href="vagas.php" class="btn-claro">Explorar vagas <i class="bi bi-arrow-right"></i></a>
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
<?php else: ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início - Primeiro Passo</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="css/dashboard/aluno.css">
    </head>

    <body>


        <?php if ($usuario == 'empresa'): ?>
            <aside class="menu">
                <img src="Imagem/logo.png" class="logo" alt="Primeiro Passo Empresas">
                <nav>
                    <ul>
                        <li><a href="dashboard.php" class="ativo"><i class="bi bi-house-door-fill"></i><span>Início</span></a>
                        </li>
                        <li><a href="vagas.php"><i class="bi bi-briefcase"></i><span>Vagas</span></a></li>
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
        <?php else: ?>

            <aside class="menu">
                <img src="imagem/logo.png" class="logo" alt="Primeiro Passo">

                <nav>
                    <ul>
                        <li><a href="dashboard.php" class="ativo"><i class="bi bi-house-door-fill"></i><span>Início</span></a>
                        </li>
                        <li><a href="vagas.php"><i class="bi bi-briefcase"></i><span>Vagas</span></a></li>
                        <li><a href="curriculo.php"><i class="bi bi-file-earmark-text"></i><span>Meu Currículo</span></a></li>
                        <li><a href="candidaturas.php"><i class="bi bi-send"></i><span>Minhas Candidaturas</span></a></li>
                        <li><a href="dicas.php"><i class="bi bi-lightbulb"></i><span>Dicas e Aprendizados</span></a></li>
                        <li><a href="perfil.php"><i class="bi bi-person-circle"></i><span>Perfil</span></a></li>
                    </ul>
                </nav>

            </aside>
        <?php endif ?>


        <div class="pagina">

            <header class="topo">

                <form class="busca" action="vagas.php" method="get" role="search">
                    <i class="bi bi-search"></i>
                    <input type="search" name="q" placeholder="Buscar vagas, cargos ou empresas...">
                </form>


                <a href="notificacoes.php" class="sino" aria-label="Notificações"><i class="bi bi-bell"></i></a>

                <details class="usuario">
                    <summary>
                        <i class="bi bi-person-circle"></i>
                        <span><?= htmlspecialchars(explode(' ', $_SESSION['nome'])[0]) ?> </span>
                        <i class="bi bi-caret-down-fill" style="font-size:12px"></i>
                    </summary>
                    <div class="sub">
                        <a href="<?= $usuario == 'empresa' ? 'perfil.php' : 'perfil.php' ?>">Meu perfil</a>
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


                        <section class="card boas">

                            <h1>Olá, <span> <?= htmlspecialchars(explode(' ', $_SESSION['nome'])[0]) ?> </span>!</h1>
                            <h3>Pronto para dar o próximo passo?</h3>
                            <p>Aqui você encontra vagas, pode montar seu currículo, acompanhar suas candidaturas e acessar
                                conteúdos que vão te ajudar a conquistar suas metas.</p>
                        </section>

                        <section>
                            <div class="cab">
                                <h2 class="titulo-bloco">Explore por área</h2>
                                <a href="vagas.php" class="ver-todas">Ver todas <i class="bi bi-arrow-right"></i></a>
                            </div>
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
                        <section class="card">

                            <div class="cab">
                                <h2 style="font-size:1.1rem;font-weight:600;display:flex;align-items:center;gap:10px">
                                    <i class="bi bi-bullseye" style="color:#1A80D5"></i>
                                    Vagas recomendadas para você
                                </h2>

                                <a href="vagas.php" class="ver-todas">
                                    Ver todas <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>

                            <?php if (count($vagas) > 0): ?>

                                <?php foreach ($vagas as $v): ?>

                                    <?php
                                    $pesquisa = $conexao->prepare("
    SELECT cd_candidatura
    FROM tb_candidaturas
    WHERE id_aluno = ?
    AND id_vaga = ?
");

                                    $pesquisa->bind_param(
                                        "ii",
                                        $_SESSION['id_aluno'],
                                        $v['id']
                                    );

                                    $pesquisa->execute();

                                    $candidatado = $pesquisa->get_result()->num_rows > 0;

                                    $palavras = preg_split('/\s+/', trim($v['nome_fantasia']));
                                    $iniciais = '';

                                    foreach (array_slice($palavras, 0, 2) as $palavra) {
                                        $iniciais .= mb_substr($palavra, 0, 1);
                                    }

                                    $iniciais = mb_strtoupper($iniciais);


                                    $data = 'Recentemente';

                                    if (!empty($v['criada_em'])) {

                                        $criacao = new DateTime($v['criada_em']);
                                        $hoje = new DateTime();

                                        $diferenca = $criacao->diff($hoje);

                                        if ($criacao > $hoje) {
                                            $data = 'Recentemente';
                                        } elseif ($diferenca->days == 0) {
                                            $data = 'Hoje';
                                        } elseif ($diferenca->days == 1) {
                                            $data = 'Há 1 dia';
                                        } elseif ($diferenca->days < 7) {
                                            $data = 'Há ' . $diferenca->days . ' dias';
                                        } elseif ($diferenca->days < 30) {
                                            $semanas = floor($diferenca->days / 7);
                                            $data = 'Há ' . $semanas . ($semanas == 1 ? ' semana' : ' semanas');
                                        } else {
                                            $meses = max(1, floor($diferenca->days / 30));
                                            $data = 'Há ' . $meses . ($meses == 1 ? ' mês' : ' meses');
                                        }
                                    }
                                    ?>

                                    <article class="vaga">

                                        <div class="logo-emp"
                                            style="background-color: <?= htmlspecialchars($v['cor_logo'] ?? '#1A80D5') ?>;">
                                            <?= htmlspecialchars($iniciais) ?>
                                        </div>

                                        <div class="info">

                                            <h4>
                                                <?= htmlspecialchars($v['titulo']) ?>
                                            </h4>

                                            <div class="emp">
                                                <i class="bi bi-patch-check-fill"></i>
                                                <?= htmlspecialchars($v['nome_fantasia']) ?>
                                            </div>

                                            <div class="meta">

                                                <span>
                                                    <i class="bi bi-briefcase"></i>
                                                    <?= htmlspecialchars($v['tipo']) ?>
                                                </span>

                                                <span>
                                                    <i class="bi bi-geo-alt"></i>
                                                    <?= htmlspecialchars($v['cidade'] . ' - ' . $v['uf']) ?>
                                                </span>

                                                <span>
                                                    <i class="bi bi-building"></i>
                                                    <?= htmlspecialchars($v['modalidade']) ?>
                                                </span>

                                            </div>

                                        </div>

                                        <div class="lado">

                                            <span class="data">
                                                <?= htmlspecialchars($data) ?>
                                            </span>

                                            <?php if ($candidatado): ?>

                                                <button class="btn-cand" disabled>
                                                    Candidatado
                                                    <i class="bi bi-check-circle"></i>
                                                </button>

                                            <?php else: ?>

                                                <a href="candidatar.php?vaga=<?= (int) $v['id'] ?>" class="btn-cand">
                                                    Candidatar-se
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>

                                            <?php endif; ?>


                                        </div>

                                    </article>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p style="padding:20px;text-align:center;color:#6B7280">
                                    Ainda não há vagas para o seu perfil.
                                </p>

                            <?php endif; ?>

                        </section>

                    </div>


                    <div class="col-dir">


                        <section class="card perfil-card">
                            <h3><i class="bi bi-graph-up-arrow"></i>Seu perfil</h3>
                            <div class="perfil-corpo">
                                <!-- PHP/BD: porcentagem do currículo. Troque o 100 em --p e no texto:
                 style="--p:<?= (int) $perfil ?>"  e  <?= (int) $perfil ?>%  (a rosca desenha sozinha via CSS) -->
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
                                <li><b>1</b><span>Mantenha seu currículo sempre atualizado com suas novas
                                        experiências.</span></li>
                                <li><b>2</b><span>Personalize sua carta de apresentação para cada vaga.</span></li>
                                <li><b>3</b><span>Participe de processos seletivos e entrevistas, mesmo que não se sinta
                                        100%
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
<?php endif; ?>