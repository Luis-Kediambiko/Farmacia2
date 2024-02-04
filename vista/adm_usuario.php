<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
?>

  <title>Adm | Editar Dados</title>
<?php
    include_once 'layouts/nav.php';
?>

<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar ação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        <img id="avatar3" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
          <b>
            <?php
              echo $_SESSION['nome_us'];
            ?>
          </b>
        </div>
        <span>Palavra passe para continuar</span>
        <div class="alert alert-success text-center" id="confirmado" style='display:none;'>
          <span><i class="fas fa-check"></i>Usuário modificado!</span>
          </div>

          <div class="alert alert-danger text-center" id="resgatar" style='display:none;'>
          <span><i class="fas fa-times"></i>Palavra-passe incorreta</span>
          </div>
        <form id="form-confirmar">
          <dib class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-unlock-alt" ></i></span>
        </div>
          <input id="oldpass" type="password" class="form-control" placeholder="Inserir palavra-passe">
          <input type="hidden" id="id_user">
          <input type="hidden" id="funcao">
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
<!-- Modal -->
<div class="modal fade" id="criarusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Criar Usuário</h3>
            <button data-dismiss="modal" aria-label="close" class="close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        <div class="card-body">
        <div class="alert alert-success text-center" id="add" style='display:none;'>
          <span><i class="fas fa-check"></i>Adicionado/a com sucesso!</span>
          </div>

          <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
          <span><i class="fas fa-times"></i>Espaço vazio ou DNI existente</span>
          </div>
            <form id="form-criar">
                <div class="from-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" class="form-control" placeholder="Informe o nome" required>      
                </div>
                <div class="from-group">
                    <label for="apelido">Último nome</label>
                    <input type="text" id="apelido" class="form-control" placeholder="Informeo último nome nome" required>      
                </div>
                <div class="from-group">
                    <label for="idade">Data de nascimento</label>
                    <input type="date" id="idade" class="form-control" placeholder="Informe a data" required>      
                </div>
                <div class="from-group">
                    <label for="dni">DNI de usuário</label>
                    <input type="text" id="dni" class="form-control" placeholder="Informe DNI de usuário" required>      
                </div>
                <div class="from-group">
                    <label for="senha">Criar senha</label>
                    <input type="password" id="senha" class="form-control" placeholder="Informe a senha" required>      
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
            <h1>Gestão de usuários<button id="button-criar" type="button" data-toggle="modal" data-target="#criarusuario" class="btn bg-gradient-primary ml-2">Criar usuários</button></h1>
            <input id="tipo_usuario" type="hidden" value="<?php echo $_SESSION['us_tipo'] ?>">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Dados pessoais</li>
            </ol>  
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section>


<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
        <h3 class="card-title">Buscar usuários</h3>
        <div class="input-group">
        <input type="text" id="buscar" class="form-control floar-left" placeholder="Inserir nome">
         <div class="input-group-append">
        <button class="btn btn-default"><i class="fas fa-search"></i></button>
        </div>
        </div>
        </div>
        <div class="card-body">
        <div id="usuarios" class="row d-flex align-items-stretch">

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
}
else{
    header('Location: ../index.php');
}
?>
<script src="../js/Gestao_usuario.js"></script>