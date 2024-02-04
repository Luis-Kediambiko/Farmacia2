<?php
include '../modelo/Produto.php';
$produto = new Produto();

if ($_POST['funcao'] == 'criar') {
    $nome = $_POST['nome'];
    $concentracao = $_POST['concentracao'];
    $adicional = $_POST['adicional'];
    $preco = $_POST['preco'];
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $apresentacao = $_POST['apresentacao'];
    $avatar = 'prod_default.jpg';
    $produto->criar($nome, $concentracao,$adicional,$preco,$laboratorio,$tipo,$apresentacao,$avatar);
}

if ($_POST['funcao'] == 'editar') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $concentracao = $_POST['concentracao'];
    $adicional = $_POST['adicional'];
    $preco = $_POST['preco'];
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $apresentacao = $_POST['apresentacao'];
    $produto->editar($id, $nome, $concentracao, $adicional, $preco, $laboratorio, $tipo, $apresentacao);
}
if ($_POST['funcao']=='buscar') {
    $produto->buscar();
    $json=array();
    foreach ($produto->objetos as $objeto) {
        $produto->obter_stock($objeto->id_produto);
        foreach ($produto->objetos as $obj) {
           $total = $obj->total;
        }
        $json[]=array(
            'id'=>$objeto->id_produto,
            'nome'=>$objeto->nome,
            'concentracao'=>$objeto->concentracao,
            'adicional'=>$objeto->adicional,
            'preco'=>$objeto->preco,
            'stock'=>$total,
            'laboratorio'=>$objeto->laboratorio,
            'tipo'=>$objeto->tipo,
            'apresentacao'=>$objeto->apresentacao,
            'laboratorio_id'=>$objeto->prod_lab,
            'tipo_id'=>$objeto->prod_tipo_prod,
            'apresentacao_id'=>$objeto->prod_presente,
            'avatar'=>'../img/prod/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcao'] == 'mudar_avatar') {
    $id = $_POST['id_logo_prod'];
    $avatar = $_POST['avatar'];
    if (($_FILES['photo']['type'] == 'image/jpeg') || ($_FILES['photo']['type'] == 'image/png') || ($_FILES['photo']['type'] == 'image/gif')) {
        $nome = uniqid() . '-' . $_FILES['photo']['name'];
        $rota = '../img/prod/' . $nome;
        move_uploaded_file($_FILES['photo']['tmp_name'], $rota);
        $produto->mudar_logo($id, $nome);
            if ($avatar != '../img/prod/prod_default.png') {
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
    $produto->eliminar($id);
}

