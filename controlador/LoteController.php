<?php
include '../modelo/Lote.php';
$lote = new Lote();

if ($_POST['funcao']=='criar') {
    $id_produto = $_POST['id_produto'];
    $fornecedor = $_POST['fornecedor'];
    $stock = $_POST['stock'];
    $vencimento = $_POST['vencimento'];
    if ($vencimento < 2023) {
        echo 'Data_invalida';
    }
    else {
        $lote->criar($id_produto,$fornecedor,$stock,$vencimento);
    }
    
}

if ($_POST['funcao']=='editar') {
    $id_lote = $_POST['id'];
    $stock = $_POST['stock'];
    $lote->editar($id_lote,$stock);
   
    
}


if ($_POST['funcao']=='buscar') {
    $lote->buscar();
    $json=array();
    $ano_atual = new DateTime();
    foreach ($lote->objetos as $objeto) {
    $vencimento = new DateTime($objeto->vencimento);
	$diferenca = $vencimento->diff($ano_atual);
	$mes = $diferenca->m;
	$dia= $diferenca->d;
    $verificado = $diferenca->invert;
    if ($verificado==0) {
       $estado='danger';
       $mes= $mes*(-1);
       $dia= $dia*(-1);
    }
    else{
        if($mes > 3){
            $estado='light';		
        }
        if($mes <= 3){
            $estado='warning';		
        }
    }
	
	
	
        $json[]=array(
            'id'=>$objeto->id_lote,
            'nome'=>$objeto->prod,
            'concentracao'=>$objeto->concentracao,
            'vencimento'=>$objeto->vencimento,
            'adicional'=>$objeto->adicional,
            'stock'=>$objeto->stock,
            'laboratorio'=>$objeto->lab,
            'tipo'=>$objeto->tipo_pro,
            'apresentacao'=>$objeto->apresent,
            'fornecedor'=>$objeto->forne,
            'avatar'=>'../img/prod/'.$objeto->logo,
            'mes'=>$mes,
            'dia'=>$dia,
            'estado'=>$estado
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
    
}


if ($_POST['funcao'] == 'eliminar'){
    $id=$_POST['id'];
    $lote->eliminar($id);
}



?>