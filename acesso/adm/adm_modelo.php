<?php

require_once '../../CTRL/ModeloCTRL.php';
require_once '../../VO/ModeloVO.php';

$ctrl = new ModeloCTRL();

//isset (Se existe) $_POST é vetorial []
if (isset($_POST['btn_gravar'])) {

  $vo = new ModeloVO();
  $vo->setNome($_POST['nome']);

  //$vo->setNome($_POST['nome']); Da no mesmo, porém com a mesma linha

  $ret = $ctrl->InserirModeloCTRL($vo);
} else if (isset($_POST['btn_excluir'])) {
  $cod = $_POST['cod_item'];
  $ret = $ctrl->ExcluirModeloCTRL($cod);

}else if (isset($_POST['btn_alterar'])) {

  $vo = new ModeloVO();
  $nome = $_POST['nome_alt'];
  $cod = $_POST['cod_alt'];
  
  $vo->setNome($nome);
  $vo->setIdModelo($cod);

  $ret = $ctrl->AlterarModeloCTRL($vo);
}

$modelos = $ctrl->ConsultarModeloCTRL();

?>

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
              <h1>Modelo de equipamento</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Modelo do equipamento</li>
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
            <h3 class="card-title">Gerencie aqui todos os modelos do equipamento</h3>

          </div>
          <div class="card-body">

            <form method="post" action="adm_modelo.php">

              <div class="form-group">
                <label>Nome modelo</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite aqui...">
              </div>
              <button class="btn btn-success" name="btn_gravar" onclick="return InserirModelo()"> Gravar </button>

            </form>

            <hr>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Modelos Cadastrados</h3>

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
                    <table class="table table-bordered" id="tabModelos">
                      <thead>
                        <tr>
                          <th>Nome do modelo</th>
                          <th>Ação</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php for ($i = 0; $i < count($modelos); $i++) { ?>

                          <tr>
                            <td><?= $modelos[$i]['nome_modelo'] ?></td>
                            <td>
                            <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosModeloAlterar('<?= $modelos[$i]['id_modelo'] ?>','<?= $modelos[$i]['nome_modelo'] ?>')">Alterar</a> <!-- a href="#" Link que "não faz nada", mas serve pra abrir modal -->
                              <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $modelos[$i]['id_modelo'] ?>','<?= $modelos[$i]['nome_modelo'] ?>')">Excluir</a>
                            </td>
                          </tr>

                        <?php } ?>

                      </tbody>
                    </table>
                    <form method="post" action="adm_modelo.php">
                      <?php include_once '../../template/_modal_excluir.php'; ?>
                    </form>
                    <form method="post" action="adm_modelo.php">
                      <?php include_once 'modal/_alterar_modelo.php'; ?>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>

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