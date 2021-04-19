<?php

require_once '../../CTRL/EquipamentoCTRL.php';
require_once '../../VO/EquipamentoVO.php';
require_once '../../CTRL/ModeloCTRL.php';
require_once '../../CTRL/UtilCTRL.php';
require_once '../../CTRL/TipoequipCTRL.php';

$ctrl_mod = new ModeloCTRL();
$ctrl_tipo = new TipoequipCTRL();
$cod = '';
$tipo = '';
$modelo = '';

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
  $ctrl = new EquipamentoCTRL();
  $cod = $_GET['cod'];
  $dados = $ctrl->DetalharEquipamento($cod);

  //Tratamento para caso o usuário mexer acidentalmente o ID na URL
  if (count($dados) == 0) {
    header('location: adm_consultarequip.php');
    exit;
  } else {
    $tipo = $dados[0]['id_tipo'];
    $modelo = $dados[0]['id_modelo'];
  }
}

//isset (Se existe) $_POST é vetorial []
if (isset($_POST['btn_gravar'])) {

  $vo = new EquipamentoVO();
  $ctrl = new EquipamentoCTRL();

  $cod = $_POST['cod'];
  $vo->setId_Equipamento($cod);

  $vo->setIdent_Equip($_POST['identificacao']);
  $vo->setId_Modelo($_POST['modelo']);
  $vo->setDesc_Equip($_POST['descricao']);
  $vo->setId_Tipo($_POST['tipo']);

  if($cod == ''){
    $ret = $ctrl->InserirEquipamentoCTRL($vo);
  } else{
    $ret = $ctrl->AlterarEquipamento($vo);
    header('location: adm_equipamento.php?cod=' . $cod . '&ret=' . $ret);
  }
}

$mods = $ctrl_mod->ConsultarModeloCTRL();
$tipos = $ctrl_tipo->ConsultarTipoCTRL();

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
              <h1><?= $cod == '' ? 'Novo' : 'Alterar' ?> Equipamento</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Equipamento</li>
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
            <h3 class="card-title"><?= $cod == '' ? 'Cadastre' : 'Altere' ?> seu equipamento aqui</h3>

          </div>
          <div class="card-body">

            <form method="post" action="adm_equipamento.php">
              <input type="hidden" name="cod" value="<?= $cod ?>">

              <div class="form-group">
                <label>Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                  <option value="">Selecione</option>
                  <?php for ($i = 0; $i < count($tipos); $i++) { ?>
                    <option value="<?= $tipos[$i]['id_tipo'] ?>" <?= $tipos[$i]['id_tipo'] == $tipo ? 'selected' : '' ?>><?= $tipos[$i]['nome_tipo'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label>Modelo</label>
                <select name="modelo" id="modelo" class="form-control">
                  <option value="">Selecione</option>
                  <?php for ($i = 0; $i < count($mods); $i++) { ?>
                    <option value="<?= $mods[$i]['id_modelo'] ?>" <?= $mods[$i]['id_modelo'] == $modelo ? 'selected' : '' ?>><?= $mods[$i]['nome_modelo'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label>Identificação</label>
                <input name="identificacao" id="identificacao" class="form-control" placeholder="Digite aqui..." value="<?= isset($dados) ? $dados[0]['ident_equip'] : '' ?>">
              </div>

              <div class="form-group">
                <label>Descrição</label>
                <textarea type="Text" name="descricao" id="descricao" class="form-control" placeholder="Digite aqui..."><?= isset($dados) ? $dados[0]['desc_equip'] : '' ?></textarea>
              </div>

              <button class="btn btn-success" name="btn_gravar" onclick="return ValidarTela(3)"><?= $cod == '' ? 'Cadastrar' : 'Alterar' ?></button>

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