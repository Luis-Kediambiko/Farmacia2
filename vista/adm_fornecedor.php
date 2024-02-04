<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
?>

  <title>Adm | Editar Dados</title>
<?php
    include_once 'layouts/nav.php';
?>
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
                            <input type="hidden" name="id_logo_forne" id="id_logo_forne">
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
<div class="modal fade" id="criafornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Criar Fornecedor</h3>
            <button data-dismiss="modal" aria-label="close" class="close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        <div class="card-body">
        <div class="alert alert-success text-center" id="add" style='display:none;'>
          <span><i class="fas fa-check"></i>Adicionado/a com sucesso!</span>
          </div>

          <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
          <span><i class="fas fa-times"></i>Espaço vazio fornecedor existente</span>
          </div>
          <div class="alert alert-success text-center" id="edit_forne" style='display:none;'>
          <span><i class="fas fa-check"></i>Editado com sucesso!</span>
          </div>

            <form id="form-criar">
                <div class="from-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" class="form-control" placeholder="Informe o nome" required>      
                </div>
                <div class="from-group">
                    <label for="telefone">Telefone</label>
                    <input type="number" id="telefone" class="form-control" placeholder="Informe o telefone">      
                </div>
                <div class="from-group">
                    <label for="correio">Correio eletrónico</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    </div>
                    <input type="email" id="correio" class="form-control" placeholder="Informe o correio">      
                </div>
                </div>
                <div class="from-group">
                    <label for="endereco">Endereço</label>
                   
                    <input type="text" id="endereco" class="form-control" placeholder="Informe o endereço" required>      
                </div>
           
             <input type="hidden" id="id_edit_forne">
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
            <h1>Gestão de fornecedores<button type="button" data-toggle="modal" data-target="#criafornecedor" class="btn bg-gradient-primary ml-2">Criar fornecedores</button></h1>
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
        <h3 class="card-title">Buscar fornecedores</h3>
        <div class="input-group">
        <input type="text" id="buscar-fornecedor" class="form-control floar-left" placeholder="Inserir nome">
         <div class="input-group-append">
        <button class="btn btn-default"><i class="fas fa-search"></i></button>
        </div>
        </div>
        </div>
        <div class="card-body">
        <div id="fornecedores" class="row d-flex align-items-stretch">

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
<script src="../js/Fornecedor.js"></script>