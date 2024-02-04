<?php

include 'connetion.php';

class Tipo
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acesso = $db->pdo;
    }

    function criar($nome)
    {
        $sql = "SELECT 	id_tipo_produto FROM tipo_produto WHERE nome=:nome";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':nome' => $nome));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO tipo_produto(nome) VALUES(:nome);";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':nome' => $nome));
            echo 'add';
        }
    }


    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM 	tipo_produto WHERE nome LIKE :consulta";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM 	tipo_produto  WHERE nome NOT LIKE '' ORDER BY 	id_tipo_produto LIMIT 65";
            $query = $this->acesso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }



    function eliminar($id)
    {
        $sql = "DELETE FROM 	tipo_produto WHERE 	id_tipo_produto=:id ";
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
        $sql = "UPDATE 	tipo_produto SET nome=:nome WHERE id_tipo_produto=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id_editado, ':nome' => $nome));
        echo 'edit';
    }
    function encher_tipo_prod()
    {
        $sql = "SELECT * FROM tipo_produto ORDER BY nome ASC";
        $query = $this->acesso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
