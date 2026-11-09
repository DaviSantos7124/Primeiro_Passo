<?php
$cd_usuario = $_SESSION['id_usuario'];
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
    SELECT
        v.*,
        t.nm_tipo AS tipo
    FROM tb_vagas v
    INNER JOIN tb_tipos_vaga t
        ON v.id_tipo_vaga = t.cd_tipo_vaga
    WHERE v.id_empresa = ?
    ORDER BY v.cd_vaga DESC
");

$pesquisa->bind_param("i", $idEmpresa);
$pesquisa->execute();

$resultado = $pesquisa->get_result();

while ($dados = $resultado->fetch_assoc()) {
    $vagas[] = $dados;
}

?>