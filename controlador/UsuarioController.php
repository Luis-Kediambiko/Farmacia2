<?php 
include_once '../modelo/Usuario.php';
session_start();
$id_usuario = $_SESSION['usuario'];
$usuario = new Usuario();
$ano_atual =new DateTime();
if($_POST['funcao']=='buscar_usuario') {
    $json= array();
    $usuario->obter_dados($_POST['dados']);
    foreach($usuario->objetos as $objeto){
        $nascimento = new DateTime($objeto->idade);
        $idade = $nascimento->diff($ano_atual);
        $idade_years = $idade->y;
        $json[] = array(
            'nome'=>$objeto->nome_us,
            'apelido'=>$objeto->apelido_us,
            'idade'=>$idade_years,
            'dni'=>$objeto->dni_us,
            'tipo'=>$objeto->nome_tipo,
            'telefone'=>$objeto->telefone_us,
            'endereco'=>$objeto->endereco_us,
            'correio'=>$objeto->correio_us,
            'genero'=>$objeto->genero_us,
            'adicional'=>$objeto->adicional_us,
            'avatar'=>'../img/'.$objeto->avatar

        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring; 
}

if ($_POST['funcao']=='capturar_dados') {
    $json= array();
    $id_usuario = $_POST['id_usuario'];
    $usuario->obter_dados($id_usuario);
    foreach($usuario->objetos as $objeto){
        $json[] = array( 
            'telefone'=>$objeto->telefone_us,
            'endereco'=>$objeto->endereco_us,
            'genero'=>$objeto->genero_us,
            'correio'=>$objeto->correio_us,
            'adicional'=>$objeto->adicional_us

        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring; 
}


if ($_POST['funcao']=='editar_usuario') {
    $id_usuario = $_POST['id_usuario'];
    $telefone= $_POST['telefone'];
    $endereco= $_POST['endereco'];
    $correio= $_POST['correio'];
    $genero= $_POST['genero'];
    $adicional= $_POST['adicional'];
    if ($genero=='Masculino' || $genero == 'Feminino' || $genero == 'masculino'|| $genero == 'feminino') {
        $usuario->editar($id_usuario, $telefone, $endereco, $correio, $genero, $adicional);
        echo 'editado';
    }
    else{
        echo 'Nao_editado';
    }
   
  
}

if($_POST['funcao']=='mudar_senha'){
	$id_usuario=$_POST['id_usuario'];
	$oldpass=$_POST['oldpass'];
	$newpass=$_POST['newpass'];
	$usuario->mudar_senha($id_usuario,$oldpass,$newpass);
}

if($_POST['funcao']=='mudar_foto'){
    if(($_FILES['photo']['type']=='image/jpeg') || ($_FILES['photo']['type']=='image/png') || ($_FILES['photo']['type']=='image/gif')){ 
        $nome = uniqid().'-'.$_FILES['photo']['name'];
        $rota = '../img/'.$nome;
        move_uploaded_file($_FILES['photo']['tmp_name'], $rota);
        $usuario->mudar_photo($id_usuario,$nome);
        foreach($usuario->objetos as $objeto){
            unlink('../img/'.$objeto->avatar);
        }
        $json = array();
        $json[]=array(
            'rota'=>$rota,
            'alert'=>'edit'

        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring; 
    }
    else {
        $json = array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring; 
    }
	
}

if($_POST['funcao']=='pesquisar_usuario') {
    $json= array();
    $usuario->buscar();
    foreach($usuario->objetos as $objeto){
        $nascimento = new DateTime($objeto->idade);
        $idade = $nascimento->diff($ano_atual);
        $idade_years = $idade->y;
        $json[] = array(
            'id'=>$objeto->id_usuario,
            'nome'=>$objeto->nome_us,
            'apelido'=>$objeto->apelido_us,
            'idade'=>$idade_years,
            'dni'=>$objeto->dni_us,
            'tipo'=>$objeto->nome_tipo,
            'telefone'=>$objeto->telefone_us,
            'endereco'=>$objeto->endereco_us,
            'correio'=>$objeto->correio_us,
            'genero'=>$objeto->genero_us,
            'adicional'=>$objeto->adicional_us,
            'avatar'=>'../img/'.$objeto->avatar,
            'tipo_usuario'=>$objeto->us_tipo

        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
}



if($_POST['funcao']=='criar_usuario'){
	$nome = $_POST['nome'];
	$apelido= $_POST['apelido'];
	$idade = $_POST['idade'];
	$dni = $_POST['dni'];
	$senha = $_POST['senha'];
    $tipo=2;
    $avatar='default.jpg';
    if ($idade >=2007 || $idade < 1932) {
        echo 'data_invalida';
    } 
    else{
        $usuario->criar($nome, $apelido, $idade, $dni, $senha, $tipo, $avatar);
    }
}


if($_POST['funcao']=='ascender'){ 
    $pass =$_POST['pass'];
    $id_ascendido =$_POST['id_usuario'];
    $usuario->ascender($pass,$id_ascendido,$id_usuario);

}

if($_POST['funcao']=='descender'){ 
    $pass =$_POST['pass'];
    $id_descendido =$_POST['id_usuario'];
    $usuario->descender($pass,$id_descendido,$id_usuario);
}

if($_POST['funcao']=='eliminar_usuario'){ 
    $pass =$_POST['pass'];
    $id_eliminado =$_POST['id_usuario'];
    $usuario->eliminar($pass,$id_eliminado,$id_usuario);
}



?>