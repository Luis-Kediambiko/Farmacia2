<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
?>

    <title>Adm | Editar Dados</title>
    <?php
    include_once 'layouts/nav.php';
    ?>

    <!-- Modal Senha-->
    <div class="modal fade" id="mudarsenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mudar Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="avatar3" src="../img/avatar.png" class="profile-user-img img-fluid ronded img-circle" width="70" heigth="70">
                    </div>
                    <div class="text-center">
                        <b>
                            <?php
                            echo $_SESSION['nome_us'];
                            ?>
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="update" style='display:none;'>
                        <span><i class="fas fa-check"></i>Senha nova inserida com sucesso!</span>
                    </div>

                    <div class="alert alert-danger text-center" id="noupdate" style='display:none;'>
                        <span><i class="fas fa-times"></i>Senha incorreta</span>
                    </div>
                    <form id="form-pass">
                        <dib class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                            </div>
                            <input id="oldpass" type="password" class="form-control" placeholder="Insere senha atual">
                        </dib>
                        <dib class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input id="newpass" type="text" class="form-control" placeholder="Insere senha nova">
                        </dib>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Photo -->
    <div class="modal fade" id="mudarphoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alterar imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="avatar1" src="../img/avatar.png" class="profile-user-img img-fluid ronded img-circle" width="70" heigth="70">
                    </div>
                    <div class="text-center">
                        <b>
                            <?php
                            echo $_SESSION['nome_us'];
                            ?>
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit" style='display:none;'>
                        <span><i class="fas fa-check"></i>Foto alterada com sucesso!</span>
                    </div>

                    <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
                        <span><i class="fas fa-times"></i>Espaço vazio ou arquivo não suportado.</span>
                    </div>
                    <form id="form-photo" enctype="multipart/form-data">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="photo" class="input-group">
                            <input type="hidden" name="funcao" value="mudar_foto">
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dados pessoais</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dados pessoais</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img id='avatar2' src="../img/avatar.png" class="profile-user-img img-fluid ronded img-circle">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" data-toggle="modal" data-target="#mudarphoto" class="btn btn-primary btn-sm mt-1">Alterar imagem</button>
                                    </div>
                                    <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario'] ?>">
                                    <h3 id="nome_us" class="profile-username text-center text-success">Nome</h3>
                                    <p id="apelido_us" class="text-muted text-center">Apelido</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Idade</b><a id="idade" class="float-right">12</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">DNI</b><a id="dni_us" class="float-right">12</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Tipo Usuário</b>
                                            <span id="us_tipo" class="float-right badge">Administrador</span>
                                        </li>

                                        <button data-toggle="modal" data-target="#mudarsenha" type="button" class="btn btn-block btn-outline-warning btn-sm">Mudar password</button>
                                    </ul>
                                </div>
                            </div>

                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Sobre mim</h3>
                                </div>
                                <div class="card-body">
                                    <strong style="color:#0B7300">
                                        <i class="fas fa-phone mr-1"></i>Telefone
                                    </strong>
                                    <p id='telefone_us' class="text-muted">932713172</p>
                                    <strong style="color:#0B7300">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Endereço
                                    </strong>
                                    <p id="endereco_us" class="text-muted">Estalagem km-12A</p>
                                    <strong style="color:#0B7300">
                                        <i class="fas fa-at mr-1"></i>Correio eletrónico
                                    </strong>
                                    <p id="correio_us" class="text-muted">pedroleslin@gmailcom</p>
                                    <strong style="color:#0B7300">
                                        <i class="fas fa-smile-wink mr-1"></i>Género
                                    </strong>
                                    <p id="genero_us" class="text-muted">Masculino</p>
                                    <strong style="color:#0B7300">
                                        <i class="fas fa-pencil-alt mr-1"></i>Informação adicional
                                    </strong>
                                    <p id="adicional_us" class="text-muted">932713172</p>
                                    <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                                    <p class="text-muted">Clique no botão se desejar editar.</p>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Editar dados pessoais</h3>
                                </div>
                                <div class="card-body">

                                    <div class="alert alert-success text-center" id="editado" style='display:none;'>
                                        <span><i class="fas fa-check"></i>Editado</span>
                                    </div>

                                    <div class="alert alert-danger text-center" id="naoeditado" style='display:none;'>
                                        <span><i class="fas fa-times"></i>Edição desabilitada</span>
                                    </div>
                                    <form id="form-usuario" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                                            <div class="col-sm-10">
                                                <input type="number" id="telefone" class="form-control" require>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="endereco" class="form-control" require>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="correio" class="col-sm-2 col-form-label">Correio eletrónico</label>
                                            <div class="col-sm-10">
                                                <input type="email" id="correio" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="genero" class="col-sm-2 col-form-label">Género</label>
                                            <div class="col-sm-10">
                                                <select name="genero" id="genero" class="form-control">
                                                    <option></option>
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Feminino">Feminino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="adicional" class="col-sm-2 col-form-label">Informação
                                                adicional</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="adicional" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10 float-right">
                                                <button class="btn btn-block btn-outline-success">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <p class="text-muted">Cuidado ao digitalizar dados errados.</p>
                                </div>
                            </div>
                        </div>
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
<script src="../js/Usuario.js"></script>