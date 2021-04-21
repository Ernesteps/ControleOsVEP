<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../CTRL/UtilCTRL.php';

$ctrl_usuario = new UsuarioCTRL();
$nome_filtro = '';

if (isset($_POST['btnFiltrar'])) {
  $nome_filtro = $_POST['nome_filtro'];
  $users = $ctrl_usuario->FiltrarUsuario($nome_filtro);
} else if (isset($_POST['btn_excluir'])){
  $cod = $_POST['cod_item'];
  $tipo = $_POST['tipo_user'];
  $ret = $ctrl_usuario->ExcluirUsuarioCTRL($cod, $tipo);
}

?>

<!-- http://localhost/controleosvep/ -->
<!DOCTYPE html>
<html>

<head>
  <?php
  // Comando para incluir uma vez o código .php para a pagina selecionada.
  include_once '../../template/_head.php';
  ?>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <?php
    include_once '../../template/_topo.php';
    include_once '../../template/_menu.php';
    ?>
    <!-- Navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Consultar Usuários</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Consultar Usuários</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Aqui você consulta os seus usuários</h3>

          </div>
          <div class="card-body">
            <form method="post" action="adm_consultarusuario.php">

              <div class="form-group">
                <label>Pesquisar por nome</label>
                <input type="text" value="<?= $nome_filtro ?>" class="form-control" placeholder="Digite aqui..." name="nome_filtro">
              </div>

              <button class="btn btn-success" name="btnFiltrar"> Buscar </button>
            </form>

            <hr>
            <?php if (isset($users)) { ?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Usuários Cadastrados</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Pesquisar">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Tipo</th>
                          <th>Ação</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php for ($i = 0; $i < count($users); $i++) { ?>
                          <tr>
                            <td><?= $users[$i]['nome_usuario'] ?></td>
                            <td><?= UtilCTRL::MostraTipoUser($users[$i]['tipo_usuario']) ?></td>
                            <td>
                              <a href="#" class="btn btn-warning btn-xs">Alterar</a>
                              <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluirUsuario('<?= $users[$i]['id_usuario'] ?>','<?= $users[$i]['nome_usuario'] ?>','<?= $users[$i]['tipo_usuario'] ?>')">Excluir</a>
                            </td>
                          </tr>
                        <?php } ?>

                      </tbody>
                    </table>
                    <form method="post" action="adm_consultarusuario.php">
                      <?php include_once '../../template/_modal_excluir.php'; ?>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          <?php } ?>
          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php

    include_once '../../template/_footer.php';
    include_once '../../template/_msg.php';
    ?>


    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</body>

</html>