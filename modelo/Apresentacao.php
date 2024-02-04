<?php

include 'connetion.php';

class Apresentacao
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acesso = $db->pdo;
    }

    function criar($nome)
    {
        $sql = "SELECT 	id_apresentacao FROM apresentacao WHERE nome=:nome";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':nome' => $nome));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO apresentacao(nome) VALUES(:nome);";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':nome' => $nome));
            echo 'add';
        }
    }


    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM apresentacao WHERE nome LIKE :consulta";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM 	apresentacao  WHERE nome NOT LIKE '' ORDER BY 	id_apresentacao LIMIT 65";
            $query = $this->acesso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }



    function eliminar($id)
    {
        $sql = "DELETE FROM apresentacao WHERE 	id_apresentacao=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'eliminado';
        } else {
            echo 'naoeliminado';
        }
    }

    function editar($nome, $id_editado)
    {
        $sql = "UPDATE 	apresentacao SET nome=:nome WHERE id_apresentacao=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id_editado, ':nome' => $nome));
        echo 'edit';
    }

    function encher_aprese_prod()
    {
        $sql = "SELECT * FROM apresentacao ORDER BY nome ASC";
        $query = $this->acesso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
