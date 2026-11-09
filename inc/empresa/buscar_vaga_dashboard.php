<?php

$a = $conexao->prepare("
    SELECT cd_empresa
    FROM tb_empresas
    WHERE id_usuario = ?
");

$a->bind_param("i", $cd_usuario);
$a->execute();

$b = $a->get_result()->fetch_assoc();

$idEmpresa = $b['cd_empresa'] ?? null;

$_SESSION['id_empresa'] = $idEmpresa;

$vagas = [];

$pesquisa = $conexao->prepare("
    SELECT *
    FROM tb_vagas
    WHERE id_empresa = ?
    ORDER BY cd_vaga DESC
    LIMIT 5
");

$pesquisa->bind_param("i", $idEmpresa);
$pesquisa->execute();

$resultado = $pesquisa->get_result();

while ($dados = $resultado->fetch_assoc()) {
    $vagas[] = $dados;
}


$pesquisa = $conexao->prepare("
    SELECT COUNT(*) AS total
    FROM tb_vagas
    WHERE id_empresa = ?
");

$pesquisa->bind_param("i", $idEmpresa);
$pesquisa->execute();

$resultado = $pesquisa->get_result()->fetch_assoc();

$totalVagas = $resultado['total'] ?? 0;


$pesquisa = $conexao->prepare("
    SELECT
        COUNT(*) AS total_candidaturas,
        SUM(CASE WHEN c.ds_status = 'Em análise' THEN 1 ELSE 0 END) AS em_analise
    FROM tb_candidaturas c
    INNER JOIN tb_vagas v
        ON c.id_vaga = v.cd_vaga
    WHERE v.id_empresa = ?
");

$pesquisa->bind_param("i", $idEmpresa);
$pesquisa->execute();

$dados = $pesquisa->get_result()->fetch_assoc();

$totalCandidaturas = $dados['total_candidaturas'] ?? 0;
$emAnalise = $dados['em_analise'] ?? 0;

$pesquisa = $conexao->prepare("
    SELECT COUNT(*) AS total
    FROM tb_candidaturas c
    INNER JOIN tb_vagas v
        ON c.id_vaga = v.cd_vaga
    WHERE v.id_empresa = ?
    AND c.ds_status = 'Contratado'
");

$pesquisa->bind_param("i", $idEmpresa);
$pesquisa->execute();

$dados = $pesquisa->get_result()->fetch_assoc();

$totalContratacoes = $dados['total'] ?? 0;

$candidaturas = [];

$pesquisa = $conexao->prepare("
    SELECT
        c.cd_candidatura,
        c.dt_candidatura,
        c.ds_status,
        a.nm_aluno,
        v.nm_titulo
    FROM tb_candidaturas c

    INNER JOIN tb_vagas v
        ON c.id_vaga = v.cd_vaga

    INNER JOIN tb_alunos a
        ON c.id_aluno = a.cd_aluno

    WHERE v.id_empresa = ?

    ORDER BY c.dt_candidatura DESC
    LIMIT 4
");

$pesquisa->bind_param("i", $idEmpresa);
$pesquisa->execute();

$resultado = $pesquisa->get_result();

while ($dados = $resultado->fetch_assoc()) {
    $candidaturas[] = $dados;
}
?>