<?php

include 'connetion.php';

class Produto
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acesso = $db->pdo;
    }

    function criar($nome, $concentracao,$adicional,$preco,$laboratorio,$tipo,$apresentacao,$avatar)
    {
        $sql = "SELECT id_produto FROM produto WHERE nome=:nome AND concentracao=:concentracao AND adicional=:adicional AND prod_lab=:laboratorio AND prod_tipo_prod=:tipo AND prod_presente=:apresentacao";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':nome' => $nome,':concentracao' => $concentracao,':adicional' => $adicional,':laboratorio' => $laboratorio,':tipo' => $tipo,':apresentacao' => $apresentacao));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO produto(nome,concentracao,adicional,preco,prod_lab,prod_tipo_prod,prod_presente,avatar) VALUES(:nome,:concentracao,:adicional,:preco,:laboratorio,:tipo,:apresentacao,:avatar);";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':nome' => $nome,':concentracao' => $concentracao,':adicional' => $adicional,':preco'=>$preco,':laboratorio' => $laboratorio,':tipo' => $tipo,':apresentacao' => $apresentacao,':avatar' => $avatar));
            echo 'add';
        }
    }

    function editar($id,$nome, $concentracao,$adicional,$preco,$laboratorio,$tipo,$apresentacao)
    {
        $sql = "SELECT id_produto FROM produto WHERE id_produto!=:id AND nome=:nome AND concentracao=:concentracao AND adicional=:adicional AND prod_lab=:laboratorio AND prod_tipo_prod=:tipo AND prod_presente=:apresentacao";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id,':nome' => $nome,':concentracao' => $concentracao,':adicional' => $adicional,':laboratorio' => $laboratorio,':tipo' => $tipo,':apresentacao' => $apresentacao));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noedit';
        } else {
            $sql = "UPDATE produto SET nome=:nome, concentracao=:concentracao, adicional=:adicional, prod_lab=:laboratorio, prod_tipo_prod=:tipo, prod_presente=:apresentacao, preco=:preco WHERE id_produto=:id";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':id' => $id,':nome' => $nome,':concentracao' => $concentracao,':adicional' => $adicional,':preco'=>$preco,':laboratorio' => $laboratorio,':tipo' => $tipo,':apresentacao' => $apresentacao,':preco' => $preco));
            echo 'edit';
        }
    }

    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "select id_produto, produto.nome as nome, concentracao,adicional,preco, laboratorio.nome as laboratorio, tipo_produto.nome as tipo,apresentacao.nome  as apresentacao, produto.avatar, prod_lab, prod_tipo_prod, prod_presente from produto join laboratorio on prod_lab=id_laboratorio join tipo_produto on prod_tipo_prod=id_tipo_produto
            join apresentacao on prod_presente=id_apresentacao and produto.nome like :consulta limit 25";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        } else {
            $sql = "select id_produto, produto.nome as nome, concentracao,adicional,preco, laboratorio.nome as laboratorio, tipo_produto.nome as tipo,apresentacao.nome  as apresentacao, produto.avatar, prod_lab, prod_tipo_prod, prod_presente from produto join laboratorio on prod_lab=id_laboratorio join tipo_produto on prod_tipo_prod=id_tipo_produto
            join apresentacao on prod_presente=id_apresentacao and produto.nome not like '' order by nome limit 25";
            $query = $this->acesso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }
    function mudar_logo($id, $nome)
    {
        $sql = "UPDATE produto SET avatar=:nome WHERE id_produto=:id";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id, ':nome' => $nome));
       
    }

    function eliminar($id)
    {
        $sql = "DELETE FROM produto  WHERE id_produto=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'eliminado';
        } else {
            echo 'naoeliminado';
        }
    }


function obter_stock($id){
    $sql = "SELECT SUM(stock) as total FROM lote WHERE lote_id_prod=:id ";
    $query = $this->acesso->prepare($sql);
    $query->execute(array(':id' => $id));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
}




}

