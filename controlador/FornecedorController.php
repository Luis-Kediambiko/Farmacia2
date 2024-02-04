<?php 
include '../modelo/Fornecedor.php';
$fornecedor = new Fornecedor();


if ($_POST['funcao'] == 'criar') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $correio = $_POST['correio'];
    $endereco = $_POST['endereco'];
    $avatar = 'forne_default.png';
    $fornecedor->criar($nome,$telefone, $correio, $endereco, $avatar);
}

if ($_POST['funcao'] == 'editar') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $correio = $_POST['correio'];
    $endereco = $_POST['endereco'];
    $fornecedor->editar($id,$nome,$telefone, $correio, $endereco);
}


if ($_POST['funcao'] == 'buscar') {
    $fornecedor->buscar();
    $json = array();
    foreach ($fornecedor->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_fornecedor,
            'nome' => $objeto->nome,
            'telefone' => $objeto->telefone,
            'correio' => $objeto->correio,
            'endereco' => $objeto->endereco,
            'avatar' => '../img/forne/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcao'] == 'mudar_logo') {
    $id = $_POST['id_logo_forne'];
    $avatar = $_POST['avatar'];
    if (($_FILES['photo']['type'] == 'image/jpeg') || ($_FILES['photo']['type'] == 'image/png') || ($_FILES['photo']['type'] == 'image/gif')) {
        $nome = uniqid() . '-' . $_FILES['photo']['name'];
        $rota = '../img/forne/' . $nome;
        move_uploaded_file($_FILES['photo']['tmp_name'], $rota);
        $fornecedor->mudar_logo($id, $nome);
            if ($avatar != '../img/forne/forne_default.png') {
                unlink($avatar);
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


if ($_POST['funcao'] == 'eliminar'){
    $id=$_POST['id'];
    $fornecedor->eliminar($id);
}


if ($_POST['funcao'] == 'encher_fornecedores') {
    $fornecedor->encher_fornecedores();
    $json = array();
    foreach ($fornecedor->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_fornecedor,
            'nome' => $objeto->nome
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}

?>