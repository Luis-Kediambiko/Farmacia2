<?php
include '../modelo/Tipo.php';
$tipo = new Tipo();

if ($_POST['funcao'] == 'criar') {
    $nome = $_POST['nome_tipo'];
    $tipo->criar($nome);
}
if ($_POST['funcao'] == 'editar') {
    $nome = $_POST['nome_tipo'];
    $id_editado = $_POST['id_editado'];
    $tipo->editar($nome, $id_editado);
}

if ($_POST['funcao'] == 'buscar-tipo') {
    $tipo->buscar();
    $json = array();
    foreach ($tipo->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_tipo_produto,
            'nome' => $objeto->nome
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcao'] == 'eliminar') {

    $id = $_POST['id'];
    $tipo->eliminar($id);
}

if ($_POST['funcao'] == 'encher_tipo_prod') {
    $tipo->encher_tipo_prod();
    $json = array();
    foreach ($tipo->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_tipo_produto,
            'nome' => $objeto->nome
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}