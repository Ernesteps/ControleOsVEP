<?php

require_once '../../CTRL/EquipamentoCTRL.php';
require_once '../../CTRL/SetorCTRL.php';
require_once '../../VO/AlocarEquipVO.php';

$ctrl_equip = new EquipamentoCTRL();
$ctrl_set = new SetorCTRL();

//isset (Se existe) $_POST é vetorial []
if (isset($_POST['btn_gravar'])) {

  $vo = new AlocarEquipVO();

  $vo->setId_setor($_POST['setor']);
  $vo->setId_Equipamento($_POST['equipamento']);

  $ret = $ctrl_equip->AlocarEquipamento($vo);
}

$setores = $ctrl_set->ConsultarSetorCTRL();
$equips = $ctrl_equip->FiltrarEquipamentosNaoAlocadoCTRL();

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
              <h1>Alocar Equipamento</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Alocar Equipamento</li>
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
            <h3 class="card-title">Aqui você aloca um equipamento no setor específico</h3>

          </div>
          <div class="card-body">
            <form method="post" action="adm_alocarequip.php">

              <div class="form-group">

                <label>Setor</label>
                <select name="setor" id="setor" class="form-control">
                  <option value="">Selecione</option>

                  <?php foreach ($setores as $item) { ?>
                    <option value="<?= $item['id_setor'] ?>">
                      <?= $item['nome_setor'] ?>
                    </option>
                  <?php } ?>

                </select>
              </div>

              <div class="form-group">
                <label>Equipamento</label>
                <select name="equipamento" id="equipamento" class="form-control">
                  <option value="">Selecione</option>

                  <?php foreach ($equips as $item) { ?>
                    <option value="<?= $item['id_equipamento'] ?>">
                      <?= $item['ident_equip'] . ' / ' . $item['desc_equip'] ?>
                    </option>
                  <?php } ?>

                </select>
              </div>

              <button class="btn btn-success" name="btn_gravar" onclick="return ValidarTela(2)"> Gravar </button>
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