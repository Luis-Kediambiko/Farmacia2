<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
?>

    <title>Adm | Atributos</title>
    <?php
    include_once 'layouts/nav.php';
    ?>
    <!-- Modal Editar lab 1 -->
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
                            <input type="hidden" name="id_logo_lab" id="id_logo_lab">
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

    <!-- Modal primeiro -->
    <div class="modal fade" id="criarlaboratorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar Laboratório</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add_lab" style='display:none;'>
                            <span><i class="fas fa-check"></i>Adicionado/a com sucesso!</span>
                        </div>

                        <div class="alert alert-danger text-center" id="noadd_lab" style='display:none;'>
                            <span><i class="fas fa-times"></i>Espaço vazio ou nome existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit_lab" style='display:none;'>
                            <span><i class="fas fa-check"></i>Editado com sucesso!</span>
                        </div>
                        <form id="form-laboratorio">
                            <div class="from-group">
                                <label for="nome-laboratorio">Nome</label>
                                <input type="text" id="nome-laboratorio" class="form-control" placeholder="Informe o nome" required>
                                <input type="hidden" id="id_edit_lab">
                            </div>
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
    <!-- Modal segundo -->
    <div class="modal fade" id="criartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar Tipo</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add_tipo" style='display:none;'>
                            <span><i class="fas fa-check"></i>Adicionado/a com sucesso!</span>
                        </div>

                        <div class="alert alert-danger text-center" id="noadd_tipo" style='display:none;'>
                            <span><i class="fas fa-times"></i>Espaço vazio ou nome existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit_tipo" style='display:none;'>
                            <span><i class="fas fa-check"></i>Editado com sucesso!</span>
                        </div>
                        <form id="form-tipo">
                            <div class="from-group">
                                <label for="nome-tipo">Nome</label>
                                <input type="text" id="nome-tipo" class="form-control" placeholder="Inserir nome" required>
                                <input type="hidden" id="id_edit_tipo">
                            </div>
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

    <!-- Modal terceiro -->


    <div class="modal fade" id="criarapresentacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar Apresentação</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add_apresentacao" style='display:none;'>
                            <span><i class="fas fa-check"></i>Adicionado/a com sucesso!</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd_apresentacao" style='display:none;'>
                            <span><i class="fas fa-times"></i>Espaço vazio apresentação existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit_apresentacao" style='display:none;'>
                            <span><i class="fas fa-check"></i>Editado com sucesso!</span>
                        </div>
                        <form id="form-apresentacao">
                            <div class="from-group">
                                <label for="nome-apresentacao">Nome</label>
                                <input type="text" id="nome-apresentacao" class="form-control" placeholder="Inserir nome" required>
                                <input type="hidden" id="id_edit_apresentacao">
                            </div>
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
                        <h1>Gestão atributos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Gestão atributo</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratório</a></li>
                                    <li class="nav-item"><a href="#tipo" class="nav-link " data-toggle="tab">Tipo</a></li>
                                    <li class="nav-item"><a href="#apresentacao" class="nav-link" data-toggle="tab">Apresentação</a></li>
                                </ul>
                            </div>
                            <div class="card-body p-0">

                                <div class="tab-content">
                                    <div class="tab-pane active" id='laboratorio'>
                                        <card class="card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar laboratótio
                                                    <button type="button" data-toggle="modal" data-target="#criarlaboratorio" class="btn bg-gradient-primary btn-sm m-2">Criar
                                                        laboratório</button>
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" id="buscar-laboratorio" class="form-control float-left" placeholder="Inserir nome...">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 table-responsive">

                                                <table class="table table hover text-nowrap">
                                                    <thead class="table-success">
                                                        <tr>
                                                            <th>Ação</th>
                                                            <th>Logo</th>
                                                            <th>Laboratorio</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-active" id="laboratorios">

                                                    </tbody>
                                                </table>



                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </card>
                                    </div>
                                    <div class="tab-pane" id='tipo'>
                                        <card class="card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar tipo
                                                    <button type="button" data-toggle="modal" data-target="#criartipo" class="btn bg-gradient-primary btn-sm m-2">Criar tipo</button>
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" id="buscar-tipo" class="form-control float-left" placeholder="Inserir nome...">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 table-responsive">

                                                <table class="table table hover text-nowrap">
                                                    <thead class="table-success">
                                                        <tr>
                                                            <th>Ação</th>
                                                            <th>Tipos</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-active" id="tipos">

                                                    </tbody>
                                                </table>



                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </card>
                                    </div>
                                    <div class="tab-pane" id='apresentacao'>
                                        <card class="card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar apresentação
                                                    <button type="button" data-toggle="modal" data-target="#criarapresentacao" class="btn bg-gradient-primary btn-sm m-2">Criar
                                                        apresentação</button>
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" id="buscar-apresentacao" class="form-control float-left" placeholder="Inserir nome...">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 table-responsive">
                                                <table class="table table hover text-nowrap">
                                                    <thead class="table-success">
                                                        <tr>
                                                            <th>Ação</th>
                                                            <th>Apresentações</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-active" id="apresentacoes">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer"></div>
                                        </card>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/laboratorio.js"></script>
<script src="../js/tipo.js"></script>
<script src="../js/apresentacao.js"></script>
