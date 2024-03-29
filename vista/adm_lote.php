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
   <div class="modal fade" id="editarlote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Editar Lote</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="edit-lote" style='display:none;'>
                            <span><i class="fas fa-check"></i>Editado com sucesso!</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noedit-lote" style='display:none;'>
                            <span><i class="fas fa-check"></i>Data inválida</span>
                        </div>
                        <form id="form-editar-lote">
                        <div class="from-group">
                                <label for="codigo_lote">Código lote: </label>
                                <label id="codigo_lote" class="badge badge-success">codigo lote</label>
                            </div>
                            <div class="from-group">
                                <label for="Stock">Stock</label>
                                <input type="number" id="stock" class="form-control" value="0" required>
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestão de lotes</h1>
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
                            <input type="text" id="buscar-lote" class="form-control floar-left" placeholder="Inserir nome">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <div id="lotes" class="row d-flex align-items-stretch">

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
<script src="../js/Lote.js"></script>