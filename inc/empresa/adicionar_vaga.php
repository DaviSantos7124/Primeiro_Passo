<?php

$titulo=$_POST['titulo'];
$tipo=$_POST['tipo'];
$categoria=$_POST['categoria'];
$regime=$_POST['regime'];
$quantidade=$_POST['quantidade'];
$estado=$_POST['estado'];
$modalidade=$_POST['modalidade'];
$cidade=$_POST['cidade'];
$descricao=$_POST['descricao'];
$atividade=$_POST['atividades'];
$requisitos=$_POST['requisitos'];



    // Dados da vaga de teste
    $titulo = "teste";
    $cidade = "Itanhaém";
    $estado = "SP";
    $regime = "CLT";
    $status = "Ativa";
    $idTipoVaga = 1;
    $idCategoriaVaga = 1;


    $cadastro = $conexao->prepare("
    INSERT INTO tb_vagas
    (id_empresa, id_tipo_vaga, id_categoria_vaga, nm_titulo, nm_cidade, sg_uf, ds_regime_contratacao, ds_status)
    VALUES (?, ?,?, ?, ?, ?, ?, ?)
");

    $cadastro->bind_param(
        "iiisssss",
        $idEmpresa,
        $idTipoVaga,
        $idCategoriaVaga,
        $titulo,
        $cidade,
        $estado,
        $regime,
        $status
    );

    $cadastro->execute();


?>