<?php

require_once '../../CTRL/Func_ChamadoCTRL.php';
require_once '../../VO/ChamadoVO.php';

//isset (Se existe) $_POST é vetorial []
if (isset($_POST['btn_gravar'])) {

  $vo = new ChamadoVO();
  $ctrl = new Func_ChamadoCTRL();

  $vo->setId_Equipamento($_POST['equipamento']);
  $vo->setDesc_problema($_POST['descricao']);

  $ret = $ctrl->InserirFunc_ChamadoCTRL($vo);
}

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
    include_once '../../template/_menufunc.php';
    ?>
    <!-- Navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Realize a abertura de chamado aqui</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                <li class="breadcrumb-item active">Abrir Chamado</li>
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
            <h3 class="card-title">Escreva uma forma clara o problema do equipamento</h3>

          </div>
          <div class="card-body">

            <form method="post" action="func_novochamado.php">

              <div class="form-group">
                <label>Escolha o equipamento</label>
                <select name="equipamento" id="equipamento" class="form-control">
                  <option value="">Selecione</option>
                </select>
              </div>

              <div class="form-group">
                <label>Escreva o problema apresentado</label>
                <textarea type="Text" name="descricao" id="descricao" class="form-control" placeholder="Digite aqui..."></textarea>
              </div>

              <button class="btn btn-success" name="btn_gravar" onclick="return ValidarTela(7)"> Gravar </button>

            </form>

            <hr>

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