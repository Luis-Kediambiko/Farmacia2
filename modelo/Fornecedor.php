<?php

include 'connetion.php';

class Fornecedor
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acesso = $db->pdo;
    }

    function criar($nome, $telefone, $correio, $endereco, $avatar)
    {
        $sql = "SELECT id_fornecedor FROM fornecedor WHERE nome=:nome";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':nome' => $nome));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO fornecedor(nome,telefone,correio,endereco,avatar) VALUES(:nome,:telefone,:correio,:endereco,:avatar);";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':nome' => $nome,':telefone' => $telefone,':correio' => $correio,':endereco' => $endereco, ':avatar' => $avatar));
            echo 'add';
        }
    }


    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM fornecedor WHERE nome LIKE :consulta";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM fornecedor  WHERE nome NOT LIKE '' ORDER BY id_fornecedor DESC LIMIT 65";
            $query = $this->acesso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }

    function mudar_logo($id, $nome)
    {
        $sql = "UPDATE fornecedor SET avatar=:nome WHERE id_fornecedor=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id, ':nome' => $nome));
       
    }
    function eliminar($id)
    {
        $sql = "DELETE FROM fornecedor  WHERE id_fornecedor=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'eliminado';
        } else {
            echo 'naoeliminado';
        }
    }

function editar($id,$nome,$telefone, $correio, $endereco){
    $sql = "SELECT id_fornecedor FROM fornecedor WHERE id_fornecedor!=:id AND nome=:nome";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id'=>$id,':nome'=>$nome));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noedit';
        } else {
            $sql="UPDATE fornecedor SET nome=:nome,telefone=:telefone,correio=:correio,endereco=:endereco  WHERE id_fornecedor=:id";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':id'=>$id,':nome'=>$nome,':telefone'=>$telefone,':correio'=>$correio,':endereco'=>$endereco));
            echo 'edit';
        }
   
}


function encher_fornecedores(){
        $sql = "SELECT * FROM fornecedor ORDER BY nome ASC";
        $query = $this->acesso->prepare($sql);
        $query->execute(array());
        $this->objetos = $query->fetchAll();
        return $this->objetos;
}




}
