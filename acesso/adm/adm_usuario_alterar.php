<?php
require_once '_vertipo_adm.php';
require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../VO/UsuarioVO.php';
require_once '../../VO/TecnicoVO.php';
require_once '../../VO/FuncionarioVO.php';
require_once '../../CTRL/SetorCTRL.php';

//Testa a URL: se tem a chave e o valor é numérico
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
  $ctrl = new UsuarioCTRL();
  $dados = $ctrl->DetalharUsuarioCTRL($_GET['cod']);

  if (count($dados) == 0) {
    header('location: adm_consultarusuario.php');
    exit;

  } else {
    //Verifica se precisa carregar o setor(ou seja, cod user 2 - Funcionário)
    if($dados[0]['tipo_usuario'] == 2){
      $ctrl_setor = new SetorCTRL();
      $setores = $ctrl_setor->ConsultarSetorCTRL();
    }
  }
} else if (isset($_POST['btn_gravar'])) {
  $ctrl = new UsuarioCTRL();

  $tipo = $_POST['tipo'];

  switch ($tipo) {
    case '1':
      $vo = new UsuarioVO();

      $vo->setIdUser($_POST['cod']);
      $vo->setNome($_POST['nome']);
      $vo->setCPF(($_POST['cpf']));

      $ret = $ctrl->AlterarUserAdm($vo);

      break;

    case '2':
      $vo = new FuncionarioVO();

      $vo->setIdUser($_POST['cod']);
      $vo->setNome($_POST['nome']);
      $vo->setCPF(($_POST['cpf']));

      $vo->setEndereco_fun($_POST['endereco']);
      $vo->setTel_fun($_POST['telefone']);
      $vo->setEmail_fun($_POST['email']);
      $vo->setIdSetor($_POST['setor']);

      $ret = $ctrl->AlterarUserFun($vo);

      break;

    case '3':
      $vo = new TecnicoVO();

      $vo->setIdUser($_POST['cod']);
      $vo->setNome($_POST['nome']);
      $vo->setCPF(($_POST['cpf']));

      $vo->setEndereco_tec($_POST['endereco']);
      $vo->setTel_tec($_POST['telefone']);
      $vo->setEmail_tec($_POST['email']);

      $ret = $ctrl->AlterarUserTec($vo);

      break;
  }
  header('location: adm_consultarusuario.php?ret=' . $ret);
}else {
  header('location: adm_consultarusuario.php');
  exit;
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
              <h1>Alterar Usuario</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Usuario</li>
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
            <h3 class="card-title">Aqui você altera um usuario</h3>

          </div>
          <div class="card-body">

            <form method="post" action="adm_usuario_alterar.php">
              <input type="hidden" name="tipo" id="tipo" value="<?= $dados[0]['tipo_usuario'] ?>">
              <input type="hidden" name="cod" id="cod" value="<?= $dados[0]['id_usuario'] ?>">

              <div class="form-group">
                <label>Nome</label>
                <input name="nome" id="nome" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['nome_usuario'] ?>">
              </div>

              <div class="form-group">
                <label>CPF</label>
                <input name="cpf" id="cpf" onchange="ValidarCPFCadastro(this.value)" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['cpf_usuario'] ?>">
                <label id="val_cpf" style="color: red; display: none"></label>
              </div>

              <?php if ($dados[0]['tipo_usuario'] == 2) { ?>
                <div class="form-group">
                  <label>Setor</label>
                  <select name="setor" id="setor" class="form-control">
                    <option value="">Selecione</option>
                    <?php foreach ($setores as $item) { ?>
                      <option value="<?= $item['id_setor'] ?>" <?= $item['id_setor'] == $dados[0]['id_setor'] ? 'selected' : '' ?>><?= $item['nome_setor'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              <?php } ?>

              <?php if ($dados[0]['tipo_usuario'] == 2 || $dados[0]['tipo_usuario'] == 3) { ?>
                <div class="form-group">
                  <label>E-mail</label>
                  <input name="email" id="email" onchange="ValidarEmailCadastro(this.value)" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['email_fun'] : $dados[0]['email_tec'] ?>">
                  <label id="val_email" style="color: red; display: none"></label>
                </div>

                <div class="form-group">
                  <label>Telefone</label>
                  <input name="telefone" id="telefone" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['tel_fun'] : $dados[0]['tel_tec'] ?>">
                </div>

                <div class="form-group">
                  <label>Endereço</label>
                  <input name="endereco" id="endereco" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['endereco_fun'] : $dados[0]['endereco_tec'] ?>">
                </div>
              <?php } ?>

              <button class="btn btn-success" id="btn_gravar" name="btn_gravar"> Alterar </button>
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