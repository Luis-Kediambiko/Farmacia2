<?php
include '../modelo/Apresentacao.php';
$apresentacao = new Apresentacao();

if ($_POST['funcao'] == 'criar') {
    $nome = $_POST['nome_apresentacao'];
    $apresentacao->criar($nome);
}
if ($_POST['funcao'] == 'editar') {
    $nome = $_POST['nome_apresentacao'];
    $id_editado = $_POST['id_editado'];
    $apresentacao->editar($nome, $id_editado);
}

if ($_POST['funcao'] == 'buscar-apresentacao') {
    $apresentacao->buscar();
    $json = array();
    foreach ($apresentacao->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_apresentacao,
            'nome' => $objeto->nome
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcao'] == 'eliminar') {
    $id = $_POST['id'];
    $apresentacao->eliminar($id);
}

if ($_POST['funcao'] == 'encher_aprese_prod') {
    $apresentacao->encher_aprese_prod();
    $json = array();
    foreach ($apresentacao->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_apresentacao,
            'nome' => $objeto->nome
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
