<?php
include '../modelo/Laboratorio.php';
$laboratorio = new Laboratorio();

if ($_POST['funcao'] == 'criar') {
    $nome = $_POST['nome_laboratorio'];
    $avatar = 'cap.png';
    $laboratorio->criar($nome, $avatar);
}
if ($_POST['funcao'] == 'editar') {
    $nome = $_POST['nome_laboratorio'];
    $id_editado = $_POST['id_editado'];
    $laboratorio->editar($nome, $id_editado);
}

if ($_POST['funcao'] == 'buscar') {
    $laboratorio->buscar();
    $json = array();
    foreach ($laboratorio->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_laboratorio,
            'nome' => $objeto->nome,
            'avatar' => '../img/lab/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}



if ($_POST['funcao'] == 'mudar_logo') {
    $id = $_POST['id_logo_lab'];
    if (($_FILES['photo']['type'] == 'image/jpeg') || ($_FILES['photo']['type'] == 'image/png') || ($_FILES['photo']['type'] == 'image/gif')) {
        $nome = uniqid() . '-' . $_FILES['photo']['name'];
        $rota = '../img/lab/' . $nome;
        move_uploaded_file($_FILES['photo']['tmp_name'], $rota);
        $laboratorio->mudar_logo($id, $nome);
        foreach ($laboratorio->objetos as $objeto) {
            if ($objeto->avatar != 'cap.png') {
                unlink('../img/lab/' . $objeto->avatar);
            }
        }
        $json = array();
        $json[] = array(
            'rota' => $rota,
            'alert' => 'edit'

        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}


if ($_POST['funcao'] == 'eliminar') {

    $id = $_POST['id'];
    $laboratorio->eliminar($id);
}

if ($_POST['funcao'] == 'encher_lab_prod') {
    $laboratorio->encher_lab_prod();
    $json = array();
    foreach ($laboratorio->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_laboratorio,
            'nome' => $objeto->nome
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}
