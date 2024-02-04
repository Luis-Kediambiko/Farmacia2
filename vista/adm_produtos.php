<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
?>

    <title>Adm | Gestão de produtos</title>
    <?php
    include_once 'layouts/nav.php';
    ?>

   <!-- Modal -->
   <div class="modal fade" id="criarlote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar Lote</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add-lote" style='display:none;'>
                            <span><i class="fas fa-check"></i>Adicionado/a com sucesso!</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd-lote" style='display:none;'>
                            <span><i class="fas fa-check"></i>Data inválida</span>
                        </div>
                        <form id="form-criar-lote">
                        <div class="from-group">
                                <label for="nome_produto_lote">Produto: </label>
                                <label id="nome_produto_lote" class="badge badge-success">Nome do produto</label>
                            </div>
                        <div class="from-group">
                                <label for="fornecedor">Fornecedor</label>
                                <select name="Fornecedor" id="fornecedor" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <div class="from-group">
                                <label for="Stock">Stock</label>
                                <input type="number" id="stock" class="form-control" value="0" required>
                            </div>
                            <div class="from-group">
                                <label for="vencimento">Data de vencimento</label>
                                <input type="date" id="vencimento" class="form-control" required>
                            </div>
                            
                            <input type="hidden" id="id_lote_prod">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right">Guardar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right mr-1">Fechar</button>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <!-- Modal Editar Logo produto  -->
    <div class="modal fade" id="mudarlogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alterar Logo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logoatual" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                    </div>
                    <div class="text-center">
                        <b id="nome_logo">

                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit" style='display:none;'>
                        <span><i class="fas fa-check"></i>Logo alterada com sucesso!</span>
                    </div>

                    <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
                        <span><i class="fas fa-times"></i>Espaço vazio ou arquivo não suportado.</span>
                    </div>
                    <form id="form-logo" enctype="multipart/form-data">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="photo" class="input-group">
                            <input type="hidden" name="funcao" id="funcao">
                            <input type="hidden" name="id_logo_prod" id="id_logo_prod">
                            <input type="hidden" name="avatar" id="avatar">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="criarproduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar Produto</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add" style='display:none;'>
                            <span><i class="fas fa-check"></i>Adicionado/a com sucesso!</span>
                        </div>

                        <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                            <span><i class="fas fa-times"></i>Produto existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                            <span><i class="fas fa-check"></i>Editado com sucesso!</span>
                        </div>
                        <form id="form-criar">
                            <div class="from-group">
                                <label for="nome_produto">Nome</label>
                                <input type="text" id="nome_produto" class="form-control" placeholder="Informe o nome" required>
                            </div>
                            <div class="from-group">
                                <label for="concentracao">Concentração</label>
                                <input type="text" id="concentracao" class="form-control" placeholder="informe a concentração">
                            </div>
                            <div class="from-group">
                                <label for="adicional">Adicional</label>
                                <input type="text" id="adicional" class="form-control" placeholder="Informe o adicional">
                            </div>
                            <div class="from-group">
                                <label for="preco">Preço do produto</label>
                                <input type="number" id="preco" class="form-control" value='0' required>
                            </div>
                            <div class="from-group">
                                <label for="laboratorio">Laboratório ou origem</label>
                                <select name="laboratorio" id="laboratorio" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <div class="from-group">
                                <label for="tipo">Tipo de produto</label>
                                <select name="tipo" id="tipo" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <div class="from-group">
                                <label for="apresentacao">Apresentação</label>
                                <select name="apresentacao" id="apresentacao" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <input type="hidden" id="id_edit_prod">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right">Guardar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right mr-1">Fechar</button>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestão de produtos<button id="button-criar" type="button" data-toggle="modal" data-target="#criarproduto" class="btn bg-gradient-primary ml-2">Criar produto</button></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Produtos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>


            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar produtos</h3>
                        <div class="input-group">
                            <input type="text" id="buscar-produto" class="form-control floar-left" placeholder="Inserir nome">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <div id="produtos" class="row d-flex align-items-stretch">

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>


        </section>

    </div>
    <!-- /.content-wrapper -->

<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/Produtos.js"></script>