<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../img/logo.png" type="image/png">
<link rel="stylesheet" href="../css/main.css">
<!-- Sweet alert 2-->
<link rel="stylesheet" href="../css/sweetalert2.css">

<!-- Select 2-->
<link rel="stylesheet" href="../css/select2.css">
<!-- Ionicons -->

<!--select2-->
<!-- Font Awesome -->
<link rel="stylesheet" href="../css/css/all.min.css">
<!-- Ionicons -->

<!-- overlayScrollbars -->
<link rel="stylesheet" href="../css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->

</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar navbar">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="adm_catalogo.php" class="nav-link">Página inicial</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"></a>
        </li>
        <li class="nav-item dropdown" id="cat_carrinho" style="display:none">
        <img src="../img/Re.png" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
</img>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <table class="carro table table.honer text-nowrap p-o">
          <thead class="table-success">
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Concentração</th>
              <th>Adicional</th>
              <th>Preço</th>
              <th>Eliminar</th>
              
            </tr>
          </thead>
          <tbody id="lista">

          </tbody>
         </table>
         <a href="#" class="btn btn-danger btn-block">Processar compra</a>
         <a href="#" id="esvaziar_carrinho" class="btn btn-success btn-block">Esvaziar o carrinho</a>
        </div>
      </li>

      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto ">
        <a href="../controlador/Logout.php"><i class="fa fas-exit-alt"></i>Terminar Sessão</a>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../vista/adm_catalogo.php" class="brand-link">
        <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Farmacia</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img id='avatar4' src="../img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <?php
              echo $_SESSION['nome_us'];
              ?>
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-header">Usuários</li>
            <li class="nav-item">
              <a href="editar_dados_pessoais.php" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Dados pessoais
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_usuario.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Gestão de usuários
                </p>
              </a>
            </li>

            <li class="nav-header">Armazém</li>
            <li class="nav-item">
              <a href="adm_produtos.php" class="nav-link">
                <i class="nav-icon fas fa-pills"></i>
                <p>
                  Gestão produtos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_atributos.php" class="nav-link">
                <i class="nav-icon fas fa-vials"></i>
                <p>
                  Gestão atributos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_lote.php" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Gestão lotes
                </p>
              </a>
            </li>
            <li class="nav-header">Compras</li>
            <li class="nav-item">
              <a href="adm_fornecedor.php" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>
                  Gestão fornecedor
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>