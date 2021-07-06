<!-- http://localhost/controleosvep/ -->
<?php

require_once '../../CTRL/ChamadoCTRL.php';
require_once '../../CTRL/UtilCTRL.php';

$FiltrarSit = '';

if(isset($_POST['btn_pesquisar'])) {

  $ctrl_chamado = new ChamadoCTRL();
  $FiltrarSit = $_POST['situacao'];
  $chamados = $ctrl_chamado->FiltrarChamadosTecCTRL(null, $FiltrarSit);

  if(count($chamados) == 0)
    $ret = 8;
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
              <h1>Filtre os chamados</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                <li class="breadcrumb-item active">Consultar Chamados</li>
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
            <h3 class="card-title">Aqui você poderá consultar e atender um chamado</h3>

          </div>
          <div class="card-body">
            <form method="post" action="tec_chamados.php">
              <div class="form-group">
                <label>Escolha a situação do chamado</label>
                <select name="situacao" id="situacao" class="form-control">
                  <option value="0" <?= $FiltrarSit == 0 ? 'selected' : '' ?>>Todos</option>
                  <option value="1" <?= $FiltrarSit == 1 ? 'selected' : '' ?>>Aguardando Atendimento</option>
                  <option value="2" <?= $FiltrarSit == 2 ? 'selected' : '' ?>>Em Atendimento</option>
                  <option value="3" <?= $FiltrarSit == 3 ? 'selected' : '' ?>>Finalizado</option>
                </select>
              </div>

              <button class="btn btn-warning" name="btn_pesquisar"> Pesquisar </button>
            </form>
            <hr>

          <?php if (isset($chamados) && count($chamados) > 0) { ?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Chamados Encontrados</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Data da abertura</th>
                          <th>Funcionário</th>
                          <th>Equipamento</th>
                          <th>Problema</th>
                          <th>Setor</th>
                          <th>Situação</th>
                          <th>Ação</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($chamados as $item) { ?>
                        <tr>
                          <td><?= UtilCTRL::DataExibir($item['data_chamado']) . ' às ' . $item['hora_chamado'] ?></td>
                          <td><?= $item['nome_funcionario'] ?></td>
                          <td><?= 'Identificação: ' . $item['ident_equip'] ?> <br> <?= 'Descrição: ' . $item['desc_equip'] ?></td>
                          <td><?= $item['desc_problema'] ?></td>
                          <td><?= $item['nome_setor'] ?></td>
                          <td>
                            <?= UtilCTRL::StuacaoChamado($item['data_atendimento'],$item['data_encerramento']) ?>
                          </td>
                          <td>
                            <a href="tec_atenderchamado.php?cod=<?= $item['id_chamado'] ?>" class="btn btn-warning btn-xs">Ver mais...</a>
                          </td>

                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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