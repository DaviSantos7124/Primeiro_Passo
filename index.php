<?php
include_once('inc/config.php');
$destaques = $conexao->query("
      SELECT
        v.cd_vaga AS id,
        v.nm_titulo AS titulo,
        v.nm_cidade AS cidade,
        v.sg_uf AS uf,
        v.vl_salario_min as vl_salario,
        v.ds_modalidade AS modalidade,
        v.dt_publicacao AS criada_em,
        e.nm_fantasia AS nome_fantasia,
        e.ds_logo AS logo,
        e.ds_cor_logo AS cor_logo,
        t.nm_tipo AS tipo

    FROM tb_vagas v

    INNER JOIN tb_empresas e
        ON v.id_empresa = e.cd_empresa

    INNER JOIN tb_tipos_vaga t
        ON v.id_tipo_vaga = t.cd_tipo_vaga

    WHERE v.ds_status = 'Ativa'

    ORDER BY v.dt_publicacao DESC
    LIMIT 4
");


    
$classeTipo = ['Estágio' => 'tp-azul', 'Jovem Aprendiz' => 'tp-roxo', 'Primeiro Emprego' => 'tp-verde'];

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro Passo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="imagem/logo.png" width="155px">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrincipal"
            aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPrincipal">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link inter" href="#">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inter" href="#">Vagas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inter" href="#">Preparar-se</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inter" href="#">Sobre nós</a>
                </li>
            </ul>

            <div class="botaos">
                <a href="login.php">
                    <button
                        style="background-color: transparent;color: #fff;border: 1px solid #fff; width: 100px;border-radius:20px;"
                        class="btn">
                        Entrar
                    </button>
                </a>
                <a href="cadastro.php">
                    <button
                        style="margin-left: 15px;background-color: #16A34A;color: #fff; width: 100px;border-radius:20px;"
                        class="btn">
                        Cadastrar
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <header>
        <div class="texto">
            <h1 class="inter">O primeiro passo para o seu <span style="color:#16A34A">futuro</span> profissional.</h1>
            <h2 class="inter-pequeno">Encontre vagas de primeiro emprego, estágio e Jovem Aprendiz, crie seu currículo e
                se prepare para o mercado de trabalho</h2>
        </div>
        <div class="card-hero"></div>
    </header>

    <section class="vagas">
        <div class="vagas-header">
            <h3 class="inter">Vagas em destaques</h3>
            <a href="#">Ver Todos <i class="bi bi-arrow-right"></i></a>
        </div>
 <div class="vagas-cards">
        <?php if ($destaques && $destaques->num_rows > 0): ?>
            <?php while ($v = $destaques->fetch_assoc()):
                $iniciais = strtoupper(mb_substr($v['nome_fantasia'], 0, 2));
                $cor = $v['cor_logo'];
                $cls = $classeTipo[$v['tipo']] ?? 'tp-azul';
                $salario = !empty($v['vl_salario'])
                    ? 'R$ ' . number_format($v['vl_salario'], 0, ',', '.') . '/mês'
                    : 'A combinar';
                ?>
                <div class="vaga-card">
                    <div class="vc-topo">
                        <div class="vc-logo" style="background:<?= $cor ?>"><?= htmlspecialchars($iniciais) ?></div>
                        <h4 class="inter"><?= htmlspecialchars($v['titulo']) ?></h4>
                    </div>
                    <div class="vc-linha"><i class="bi bi-patch-check-fill"></i><?= htmlspecialchars($v['nome_fantasia']) ?></div>
                    <div class="vc-linha"><i
                            class="bi bi-geo-alt"></i><?= htmlspecialchars($v['cidade'] . ' - ' . $v['uf']) ?></div>
                    <div class="vc-tags">
                        <span class="tag <?= $cls ?>"><?= htmlspecialchars($v['tipo']) ?></span>
                        <span class="tag tp-cinza"><?= htmlspecialchars($v['modalidade'] ?? '') ?></span>
                    </div>
                    <div class="vc-rodape">
                        <span class="vc-salario"><?= $salario ?></span>
                        <a href="login.php" class="vc-seta" aria-label="Ver vaga"><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color:#6B7280">Em breve, novas vagas por aqui.</p>
        <?php endif; ?>
 </div>
        <div class="como-funciona">
            <h3 class="inter">Como Funciona?</h3>
            <h5>É simples e rápido. Veja como você pode começar.</h5>

            <div class="passos">
                <div class="info">
                    <div class="bola">
                        <h2>1</h2>
                    </div>
                    <h4>Crie sua conta</h4>
                    <h6>É rápido e gratuito.</h6>
                </div>
                <div class="info">
                    <div class="bola">
                        <h2>2</h2>
                    </div>
                    <h4>Complete o seu perfil</h4>
                    <h6>Adicione suas habilidades e interesses</h6>
                </div>
                <div class="info">
                    <div class="bola">
                        <h2>3</h2>
                    </div>
                    <h4>Encontre a vaga ideal</h4>
                    <h6>Use os filtros e receba recomendações</h6>
                </div>
                <div class="info">
                    <div class="bola">
                        <h2>4</h2>
                    </div>
                    <h4>Candidate-se e acompanhe</h4>
                    <h6>Fique por dentro de todo o processo</h6>
                </div>
            </div>
        </div>
        
    </section>

    <footer>
        <div class="row">
            <div style="width: 320px;">
                <img src="imagem/logo.png" height="80">
                <h5 class="mt-4 inter-medio">O primeiro passo para o seu futuro profissional.</h5>
                <div style="background-color: #03C276;width:90px;height:8px;" class="mt-3"></div>
                <h5 class="mt-4 inter-pequeno" style="font-size: 15px;">Ajudamos jovens a encontrar oportunidades de
                    primeiro emprego, estágio e Jovem Aprendiz.</h5>
            </div>

            <div style="width: 180px;" class="mt-2">
                <h5 class="inter">Links</h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Início</h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Vagas</h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Preparar-se</h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Sobre nós</h5>
            </div>

            <div style="width: 240px;" class="mt-2">
                <h5 class="inter">Para estudantes</h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Encontrar vagas
                </h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Criar currículo
                </h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Minhas
                    candidaturas</h5>
            </div>

            <div style="width: 240px;" class="mt-2">
                <h5 class="inter">Para empresas</h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Cadastrar vaga
                </h5>
                <h5 class="inter-pequeno"><i class="bi bi-chevron-right" style="color: #1A80D5;"></i> Encontrar
                    candidatos</h5>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
</body>

</html>