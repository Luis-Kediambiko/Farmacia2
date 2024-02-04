<?php
include_once 'Connetion.php';
class Usuario{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acesso=$db->pdo;
    }
    function Login_inicio($dni,$pass){
        $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where dni_us=:dni and senha_us=:pass";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':dni' => $dni,':pass'=>$pass));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
    function obter_dados($id){
        $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and id_usuario=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
   function editar($id_usuario,$telefone,$endereco,$correio,$genero,$adicional){
        $sql="UPDATE usuario SET telefone_us=:telefone, endereco_us=:endereco, correio_us=:correio, genero_us=:genero, adicional_us=:adicional WHERE id_usuario=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefone'=>$telefone,':endereco'=>$endereco,':correio'=>$correio,':genero'=>$genero,':adicional'=>$adicional));
   }
   function mudar_senha($id_usuario,$oldpass,$newpass){
        $sql="SELECT * FROM usuario WHERE  id_usuario=:id AND senha_us=:oldpass";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario, ':oldpass'=>$oldpass));
        $this->objetos = $query->fetchAll();
            if(!empty($this->objetos)){
            $sql ="UPDATE usuario SET senha_us=:newpass WHERE id_usuario=:id";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario, ':newpass'=>$newpass));
            echo 'update';
        }
        else{
            echo 'nopdate';
        }
}

function mudar_photo($id_usuario, $nome){
        $sql="SELECT avatar FROM usuario WHERE  id_usuario=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos = $query->fetchAll();
        $sql="UPDATE usuario SET avatar =:nome WHERE id_usuario=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':nome'=>$nome));
        return $this->objetos;          
}

function buscar(){
    if(!empty($_POST['consulta'])){
        $consulta =$_POST['consulta'];
        $sql ="SELECT * FROM usuario join tipo_us ON us_tipo=id_tipo_us WHERE nome_us LIKE :consulta";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':consulta'=>"%$consulta%"));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    
    }
    else{
        $sql ="SELECT * FROM usuario join tipo_us ON us_tipo=id_tipo_us WHERE nome_us NOT LIKE '' ORDER BY id_usuario LIMIT 25";
        $query = $this->acesso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos; }
    
    
 }

function criar($nome,$apelido, $idade, $dni, $senha,$tipo,$avatar){
        $sql = "SELECT id_usuario FROM usuario WHERE dni_us=:dni and idade=:idade";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':dni'=>$dni, ':idade'=>$idade));
        $this->objetos = $query->fetchAll();
        if(!empty($this->objetos)){

            echo 'noadd';
        }
        else{
            $sql ="INSERT INTO usuario(nome_us,apelido_us,idade,dni_us,senha_us,us_tipo,avatar) VALUES(:nome,:apelido,:idade,:dni,:senha,:tipo,:avatar);";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':nome'=>$nome, ':apelido'=>$apelido,':idade'=>$idade,':dni'=>$dni,':senha'=>$senha,':tipo'=>$tipo,':avatar'=>$avatar));
             
            echo 'add';
        }
} 

function ascender($pass,$id_ascendido,$id_usuario){
        $sql ="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND senha_us=:pass";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            $tipo=1;
            $sql ="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario =:id";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
            echo 'ascendido';
        }
        else {
            echo 'naoascendido';
        }
}

function descender($pass,$id_descendido,$id_usuario){
    $sql ="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND senha_us=:pass";
    $query = $this->acesso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
    $this->objetos = $query->fetchAll();
    if (!empty($this->objetos)) {
        $tipo=2;
        $sql ="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario =:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
        echo 'descendido';
    }
    else {
        echo 'naodescendido';
    }
    
}


function eliminar($pass,$id_eliminado,$id_usuario){
    $sql ="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND senha_us=:pass";
    $query = $this->acesso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
    $this->objetos = $query->fetchAll();
    if (!empty($this->objetos)) {
        $sql ="DELETE FROM usuario WHERE id_usuario=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id'=>$id_eliminado));
        echo 'eliminado';
    }
    else {
        echo 'naoeliminado';
    }
    

}





}
?>