<?php
require_once '_vertipo_adm.php';
require_once '../../CTRL/TipoequipCTRL.php';
require_once '../../CTRL/EquipamentoCTRL.php';

$ctrl_tipo = new TipoequipCTRL();
$tipos = $ctrl_tipo->ConsultarTipoCTRL();

$idTipo = '';

if (isset($_POST['btn_pesquisar'])) {
  $ctrl_eq = new EquipamentoCTRL();
  $idTipo = $_POST['tipo'];
  $eqs = $ctrl_eq->PesquisarEquipamentoCTRL($idTipo);

} else if (isset($_POST['btn_excluir'])) {
  $ctrl = new EquipamentoCTRL();
  $cod = $_POST['cod_item'];
  $ret = $ctrl->ExcluirEquipamentoCTRL($cod);
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
              <h1>Consultar Equipamento</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Consultar Equipamento</li>
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
            <h3 class="card-title">Aqui você faz a consulta dos seus equipamentos</h3>

          </div>
          <div class="card-body">
            <form method="post" action="adm_consultarequip.php">

              <div class="form-group">
                <label>Pesquisar por tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                  <option value="">Selecione</option>
                  <?php for ($i = 0; $i < count($tipos); $i++) { ?>
                    <option value="<?= $tipos[$i]['id_tipo'] ?>" <?= $tipos[$i]['id_tipo'] == $idTipo ? 'selected' : '' ?>><?= $tipos[$i]['nome_tipo'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <button class="btn btn-success" name="btn_pesquisar" onclick="return ValidarTela(13)"> Buscar </button>
            </form>

            <hr>

          <?php if(isset($eqs)){ ?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Tipos Cadastrados</h3>

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
                          <th>Identificação</th>
                          <th>Descrição</th>
                          <th>Modelo</th>
                          <th>Tipo</th>
                          <th>Ação</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php for ($i = 0; $i < count($eqs); $i++) { ?>
                          <tr>
                            <td><?= $eqs[$i]['ident_equip'] ?></td>
                            <td><?= $eqs[$i]['desc_equip'] ?></td>
                            <td><?= $eqs[$i]['nome_modelo'] ?></td>
                            <td><?= $eqs[$i]['nome_tipo'] ?></td>
                            <td>
                              <a href="adm_equipamento.php?cod=<?= $eqs[$i]['id_equipamento'] ?>" class="btn btn-warning btn-xs">Alterar</a>
                              <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $eqs[$i]['id_equipamento'] ?>','<?= $eqs[$i]['ident_equip'] ?>')">Excluir</a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <form method="post" action="adm_consultarequip.php">
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