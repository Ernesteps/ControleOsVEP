<?php
require_once '_vertipo_adm.php';
require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../VO/UsuarioVO.php';
require_once '../../VO/TecnicoVO.php';
require_once '../../VO/FuncionarioVO.php';
require_once '../../CTRL/SetorCTRL.php';

if (isset($_POST['btn_gravar'])) {
  $ctrl = new UsuarioCTRL();

  $tipo = $_POST['tipo'];

  switch ($tipo) {
    case '1':
      $vo = new UsuarioVO();

      $vo->setTipo($tipo);
      $vo->setNome($_POST['nome']);
      $vo->setCPF(($_POST['cpf']));

      $ret = $ctrl->InserirUsuarioCTRL($vo);

      break;

    case '2':
      $vo = new FuncionarioVO();

      $vo->setTipo($tipo);
      $vo->setNome($_POST['nome']);
      $vo->setCPF(($_POST['cpf']));

      $vo->setEndereco_fun($_POST['endereco']);
      $vo->setTel_fun($_POST['telefone']);
      $vo->setEmail_fun($_POST['email']);
      $vo->setIdSetor($_POST['setor']);

      $ret = $ctrl->InserirFuncionarioCTRL($vo);

      break;

    case '3':
      $vo = new TecnicoVO();

      $vo->setTipo($tipo);
      $vo->setNome($_POST['nome']);
      $vo->setCPF(($_POST['cpf']));

      $vo->setEndereco_tec($_POST['endereco']);
      $vo->setTel_tec($_POST['telefone']);
      $vo->setEmail_tec($_POST['email']);

      $ret = $ctrl->InserirTecnicoCTRL($vo);

      break;
  }
}

$ctrl_setor = new SetorCTRL();
$setores = $ctrl_setor->ConsultarSetorCTRL();

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
              <h1>Novo Usuario</h1>
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
            <h3 class="card-title">Aqui você insere um novo usuario</h3>

          </div>
          <div class="card-body">
            <form method="post" action="adm_usuario.php">
              <input type="hidden" id="cod">

              <div class="form-group">
                <label>Tipo</label>
                <select name="tipo" id="tipo" class="form-control" onchange="MostrarTipoUsuario(this.value)">
                  <option value="">Selecione</option>
                  <option value="1">Administrador</option>
                  <option value="2">Funcionario</option>
                  <option value="3">Técnico</option>
                </select>
              </div>

              <div id="divTipo123" style="display: none;">
                <div class="form-group">
                  <label>Nome</label>
                  <input name="nome" id="nome" class="form-control" placeholder="Digite aqui...">
                </div>

                <div class="form-group">
                  <label>CPF</label>
                  <input name="cpf" id="cpf" onchange="ValidarCPFCadastro(this.value)" class="form-control num cpf" placeholder="Digite aqui...">
                  <label id="val_cpf" style="color: red; display: none"></label>
                </div>
              </div>

              <div id="divTipo2" style="display: none;">
                <div class="form-group">
                  <label>Setor</label>
                  <select name="setor" id="setor" class="form-control">
                    <option value="">Selecione</option>
                    <?php foreach ($setores as $item) { ?>
                      <option value="<?= $item['id_setor'] ?>"><?= $item['nome_setor'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div id="divTipo23" style="display: none;">
                <div class="form-group">
                  <label>E-mail</label>
                  <input name="email" id="email" onchange="ValidarEmailCadastro(this.value)" class="form-control" placeholder="Digite aqui...">
                  <label id="val_email" style="color: red; display: none"></label>
                </div>

                <div class="form-group">
                  <label>Telefone</label>
                  <input name="telefone" id="telefone" class="form-control" placeholder="Digite aqui...">
                </div>

                <div class="form-group">
                  <label>Endereço</label>
                  <input name="endereco" id="endereco" class="form-control" placeholder="Digite aqui...">
                </div>
              </div>

              <button class="btn btn-success" id="btn_gravar" style="display: none;" name="btn_gravar" onclick="return ValidarTela(6)"> Gravar </button>
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