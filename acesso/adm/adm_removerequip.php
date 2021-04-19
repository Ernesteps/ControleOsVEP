<?php

require_once '../../CTRL/SetorCTRL.php';
require_once '../../CTRL/EquipamentoCTRL.php';
require_once '../../VO/AlocarEquipVO.php';

$ctrl_set = new SetorCTRL();
$setor = '';

if (isset($_POST['btn_procurar'])) {
  $setor = $_POST['setor'];
  $ctrl = new EquipamentoCTRL();
  $eqs = $ctrl->FiltrarAlocado($setor);
} else if (isset($_POST['btn_excluir'])) {

  $vo = new AlocarEquipVO();
  $ctrl_equip = new EquipamentoCTRL();
  $cod = $_POST['cod_item'];
  $vo->setIdalocar_equip($cod);
  $ret = $ctrl_equip->RemoverEquipamento($vo);
}

$setores = $ctrl_set->ConsultarSetorCTRL();

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
              <h1>Remover Equipamento</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Remover Equipamento</li>
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
            <h3 class="card-title">Aqui você poderá remover seus equipamentos</h3>

          </div>
          <div class="card-body">

            <form method="post" action="adm_removerequip.php">
              <div class="form-group">
                <label>Setor</label>
                <select name="setor" id="setor" class="form-control">
                  <option value="">Selecione</option>
                  <?php foreach ($setores as $item) { ?>
                    <option value="<?= $item['id_setor'] ?>" <?= $item['id_setor'] == $setor ? 'selected' : '' ?>> <?= $item['nome_setor'] ?> </option>
                  <?php } ?>
                </select>
              </div>

              <button class="btn btn-success" onclick="return ValidarTela(14)" name="btn_procurar"> Procurar </button>
            </form>
            <hr>

            <?php if (isset($eqs)) { ?>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Equipamentos Alocados</h3>

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
                            <th>Equipamento</th>
                            <th>Ação</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php for ($i = 0; $i < count($eqs); $i++) { ?>

                            <tr>
                              <td><?= $eqs[$i]['ident_equip'] ?> / <?= $eqs[$i]['desc_equip'] ?></td>
                              <td>
                                <?php if ($eqs[$i]['sit_alocar'] != 3) { ?>
                                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $eqs[$i]['id_alocar_equip'] ?>','<?= $eqs[$i]['ident_equip'] ?> / <?= $eqs[$i]['desc_equip'] ?>')">Remover</a>
                                <?php } else {
                                  echo '<i>Em manutenção</i>';
                                } ?>
                              </td>

                            </tr>
                          <?php } ?>

                        </tbody>
                      </table>
                      <form method="post" action="adm_removerequip.php">
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