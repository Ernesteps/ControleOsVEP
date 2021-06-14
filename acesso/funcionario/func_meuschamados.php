<?php

require_once '../../CTRL/ChamadoCTRL.php';

$ctrl_chamado = new ChamadoCTRL();
$FiltrarSit = '';

if (isset($_POST['btn_pesquisar'])) {
  $FiltrarSit = $_POST['situacao'];
  $filtrar_chamados = $ctrl_chamado->FiltrarChamadoSetorCTRL($FiltrarSit);
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
              <h1>Filtre os chamados do Setor</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                <li class="breadcrumb-item active">Chamados do Setor</li>
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
            <h3 class="card-title">Aqui você visualiza todos os seus chamados realizados</h3>

          </div>
          <div class="card-body">
            <form method="post" action="func_meuschamados.php">
              <div class="form-group">
                <label>Escolha a situação do chamado</label>
                <select name="situacao" id="situacao" class="form-control">
                  <option value="0" <?= $FiltrarSit == 0 ? 'selected' : '' ?>>Todos</option>
                  <option value="1" <?= $FiltrarSit == 1 ? 'selected' : '' ?>>Aguardando Atendimento</option>
                  <option value="2" <?= $FiltrarSit == 2 ? 'selected' : '' ?>>Em Atendidmento</option>
                  <option value="3" <?= $FiltrarSit == 3 ? 'selected' : '' ?>>Finalizado</option>
                </select>
              </div>

              <button class="btn btn-warning" name="btn_pesquisar"> Pesquisar </button>
            </form>
            <hr>

            <?php if (isset($filtrar_chamados)) { ?>
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
                            <th>Data Atendimento</th>
                            <th>Técnico</th>
                            <th>Data Encerramento</th>
                            <th>Laudo</th>
                            <th>Ação</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php for ($i = 0; $i < count($filtrar_chamados); $i++) { ?>
                            <tr>
                              <td><?= $filtrar_chamados[$i]['data_chamado'] ?></td>
                              <td><?= $filtrar_chamados[$i]['nome_funcionario'] ?></td>
                              <td><?= 'Identificação: ' . $filtrar_chamados[$i]['ident_equip'] ?> <br> <?= 'Descrição: ' . $filtrar_chamados[$i]['desc_equip'] ?></td>
                              <td><?= $filtrar_chamados[$i]['desc_problema'] ?></td>
                              <td><?= $filtrar_chamados[$i]['data_atendimento'] ?></td>
                              <td><?= $filtrar_chamados[$i]['nome_tecnico'] ?></td>
                              <td><?= $filtrar_chamados[$i]['data_encerramento'] ?></td>
                              <td><?= $filtrar_chamados[$i]['laudo_chamado'] ?></td>
                              <td>
                                  <a href="#" class="btn btn-warning btn-xs" name="btn_vermais" id="btn_vermais">Ver mais...</a>
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

    ?>


    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</body>

</html>