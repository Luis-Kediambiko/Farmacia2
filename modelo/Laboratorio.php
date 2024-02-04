<?php

include 'connetion.php';

class Laboratorio
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acesso = $db->pdo;
    }

    function criar($nome, $avatar)
    {
        $sql = "SELECT id_laboratorio FROM laboratorio WHERE nome=:nome";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':nome' => $nome));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO laboratorio(nome,avatar) VALUES(:nome,:avatar);";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':nome' => $nome, ':avatar' => $avatar));
            echo 'add';
        }
    }


    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM laboratorio WHERE nome LIKE :consulta";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM laboratorio  WHERE nome NOT LIKE '' ORDER BY id_laboratorio LIMIT 65";
            $query = $this->acesso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }

    function mudar_logo($id, $nome)
    {
        $sql = "SELECT avatar FROM laboratorio WHERE  id_laboratorio=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
        $sql = "UPDATE laboratorio SET avatar =:nome WHERE id_laboratorio=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id, ':nome' => $nome));
        return $this->objetos;
    }


    function eliminar($id)
    {
        $sql = "DELETE FROM laboratorio WHERE id_laboratorio=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'eliminado';
        } 
        else {
            echo 'naoeliminado';
        }
    }

    function editar($nome, $id_editado)
    {
        $sql = "UPDATE laboratorio SET nome=:nome WHERE id_laboratorio=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id_editado, ':nome' => $nome));
        echo 'edit';
    }

    function encher_lab_prod()
    {
        $sql = "SELECT * FROM laboratorio ORDER BY nome ASC";
        $query = $this->acesso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
