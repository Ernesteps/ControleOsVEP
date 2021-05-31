<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../VO/TecnicoVO.php';
require_once '../../CTRL/UtilCTRL.php';

$ctrl = new UsuarioCTRL();

//isset (Se existe) $_POST é vetorial []
if (isset($_POST['btn_gravar'])) {

    $vo = new TecnicoVO();

    $vo->setEndereco_tec($_POST['endereco']);
    $vo->setTel_tec($_POST['telefone']);
    $vo->setEmail_tec($_POST['email']);

    $ret = $ctrl->AlterarUserTecSolo($vo);
}

$dados = $ctrl->DetalharUsuarioCTRL('');

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
                            <h1>Atualiza suas informações</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
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

                        <form method="post" action="tec_meusdados.php">

                            <div class="form-group">
                                <label>Nome</label>
                                <input name="nome" id="nome" readonly class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['nome_usuario'] ?>">
                            </div>

                            <div class="form-group">
                                <label>CPF</label>
                                <input name="cpf" id="cpf" readonly class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['cpf_usuario'] ?>">
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <input name="email" id="email" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['email_tec'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Telefone</label>
                                <input name="telefone" id="telefone" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['tel_tec'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Endereço</label>
                                <input name="endereco" id="endereco" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['endereco_tec'] ?>">
                            </div>

                            <button class="btn btn-success" name="btn_gravar" onclick="return ValidarTela(11)"> Alterar </button>

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