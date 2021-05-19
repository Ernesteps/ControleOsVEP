<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../VO/UsuarioVO.php';
require_once '../../VO/FuncionarioVO.php';
require_once '../../CTRL/UtilCTRL.php';
require_once '../../CTRL/SetorCTRL.php';

require_once '../../CTRL/Func_MeusdadosCTRL.php';

//isset (Se existe) $_POST é vetorial []

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $ctrl = new UsuarioCTRL();
    $dados = $ctrl->DetalharUsuarioCTRL(19);
}

if (isset($_POST['btn_gravar'])) {

    $vo = new FuncionarioVO();
    $ctrl = new UsuarioCTRL();

    //   $vo->setNome($_POST['nome']);
    //   $vo->setEmail_fun($_POST['email']);
    //   $vo->setTel_fun($_POST['telefone']);
    //   $vo->setEndereco_fun($_POST['endereco']);

    //   $ret = $ctrl->InserirFunc_MeusdadosCTRL($vo);

    $vo->setIdUser($_POST['cod']);
    $vo->setNome($_POST['nome']);
    $vo->setCPF(($_POST['cpf']));
    $vo->setEndereco_fun($_POST['endereco']);
    $vo->setTel_fun($_POST['telefone']);
    $vo->setEmail_fun($_POST['email']);
    $vo->setIdSetor($_POST['setor']);

    $ret = $ctrl->AlterarUserFun($vo);
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
                            <h1>Atualiza suas informações</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                                <li class="breadcrumb-item active">Meus dados</li>
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
                        <h3 class="card-title">Matenha seus dados atualizados aqui</h3>

                    </div>
                    <div class="card-body">

                        <form method="post" action="func_meusdados.php">

                            <div class="form-group">
                                <label>Nome</label>
                                <input name="nome" id="nome" readonly class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['nome_usuario'] ?>">
                            </div>

                            <div class="form-group">
                                <label>CPF</label>
                                <input name="cpf" id="cpf" readonly class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['cpf_usuario'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Setor</label>
                                <select name="setor" id="setor" class="form-control">
                                    <option value="">Selecione</option>
                                    <?php foreach ($setores as $item) { ?>
                                        <option value="<?= $item['id_setor'] ?>" <?= $item['id_setor'] == $dados[0]['id_setor'] ? 'selected' : '' ?>><?= $item['nome_setor'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <input name="email" id="email" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['email_fun'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Telefone</label>
                                <input name="telefone" id="telefone" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['tel_fun'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Endereço</label>
                                <input name="endereco" id="endereco" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['endereco_fun'] ?>">
                            </div>

                            <button class="btn btn-success" name="btn_gravar" id="btn_gravar" onclick="return ValidarTela(8)"> Alterar </button>

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