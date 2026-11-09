<?php
    $vagas = [];
    $cidade = $_SESSION['cidade'];

    $pesquisa = $conexao->prepare("
    SELECT
        v.cd_vaga AS id,
        v.nm_titulo AS titulo,
        v.nm_cidade AS cidade,
        v.sg_uf AS uf,
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
    AND v.nm_cidade = ?

    ORDER BY v.dt_publicacao DESC
    LIMIT 4
");

    $pesquisa->bind_param("s", $cidade);
    $pesquisa->execute();

    $vagasCidade = $pesquisa->get_result();

    while ($vagasCid = $vagasCidade->fetch_assoc()) {
        $vagas[] = $vagasCid;
    }

?>