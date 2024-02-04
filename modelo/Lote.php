<?php

include 'connetion.php';

class Lote
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acesso = $db->pdo;
    }

    function criar($id_produto,$fornecedor,$stock,$vencimento)
    {
        $sql = "INSERT INTO lote(stock,vencimento,lote_id_prod,lote_id_forne) VALUES(:stock, :vencimento, :produto, :fornecedor)";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':stock' => $stock, ':vencimento' => $vencimento, ':produto' => $id_produto,':fornecedor' => $fornecedor));
        $this->objetos = $query->fetchAll();
        echo 'add';
        
    }


    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT id_lote, stock, vencimento, concentracao, adicional, produto.nome as prod, laboratorio.nome as lab, tipo_produto.nome as tipo_pro, apresentacao.nome as apresent, fornecedor.nome as forne, produto.avatar as logo 
            FROM lote 
            JOIN fornecedor on lote_id_forne = id_fornecedor
            JOIN produto on lote_id_prod = id_produto
            JOIN laboratorio on prod_lab = id_laboratorio
            JOIN tipo_produto on prod_tipo_prod = id_tipo_produto
            JOIN apresentacao on prod_presente = id_apresentacao AND produto.nome  LIKE :consulta ORDER BY produto.nome LIMIT 25";
            $query = $this->acesso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        } else {
            $sql = "SELECT id_lote, stock, vencimento, concentracao, adicional, produto.nome as prod, laboratorio.nome as lab, tipo_produto.nome as tipo_pro, apresentacao.nome as apresent, fornecedor.nome as forne, produto.avatar as logo 
            FROM lote 
            JOIN fornecedor on lote_id_forne = id_fornecedor
            JOIN produto on lote_id_prod = id_produto
            JOIN laboratorio on prod_lab = id_laboratorio
            JOIN tipo_produto on prod_tipo_prod = id_tipo_produto
            JOIN apresentacao on prod_presente = id_apresentacao AND produto.nome NOT LIKE '' ORDER BY produto.nome LIMIT 25";
            $query = $this->acesso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }

function editar($id,$stock){
    $sql="UPDATE lote SET stock=:stock  WHERE id_lote=:id";
    $query = $this->acesso->prepare($sql);
    $query->execute(array(':id'=>$id,':stock'=>$stock));
    echo 'edit';
   
}

function eliminar($id)
    {
        $sql = "DELETE FROM lote  WHERE id_lote=:id ";
        $query = $this->acesso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'eliminado';
        } else {
            echo 'naoeliminado';
        }
    }






}
