<?php

require_once '../../CTRL/ChamadoCTRL.php';
require_once '../../VO/ChamadoVO.php';
require_once '../../CTRL/UtilCTRL.php';

$ctrl = new ChamadoCTRL();
$cod = '';

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $cod = $_GET['cod'];
    $dados = $ctrl->FiltrarChamadosTecCTRL($cod, null);

    if (count($dados) == 0) {
        header('location: tec_chamados.php');
        exit;
    }
}

if (isset($_POST['btn_atender'])) {

    $cod = $_POST['cod'];
    $vo = new ChamadoVO();
    $vo->setId_Chamado($cod);
    
    $ret = $ctrl->AtenderChamadoCTRL($vo);
    header('location: tec_atenderchamado.php?cod=' . $cod . '&ret=' . $ret);
}

if (isset($_POST['btn_finalizar'])) {

    $cod = $_POST['cod'];
    $vo = new ChamadoVO();
    $vo->setId_Chamado($cod);
    $vo->setLaudo_Chamado($_POST['laudo']);

    $ret = $ctrl->EncerrarChamadoCTRL($vo);
    header('location: tec_atenderchamado.php?cod=' . $cod . '&ret=' . $ret);
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
                            <h1>Atendimento ao chamado</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Atender Chamado</li>
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
                        <h3 class="card-title">Faça o atendimento</h3>

                    </div>
                    <div class="card-body">
                        <form method="post" action="tec_atenderchamado.php">
                            <input type="hidden" name="cod" value="<?= $cod ?>">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Data do chamado</label>
                                        <input id="data_chamado" name="data_chamado" disabled class="form-control" value="<?= isset($dados) ? UtilCTRL::DataExibir($dados[0]['data_chamado']) . ' às ' . $dados[0]['hora_chamado'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Funcionário</label>
                                        <input id="funcionario" name="funcionario" disabled class="form-control" value="<?= isset($dados) ? $dados[0]['nome_funcionario'] : '' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Setor</label>
                                        <input id="setor" name="setor" disabled class="form-control" value="<?= isset($dados) ? $dados[0]['nome_setor'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Equipamento</label>
                                        <input id="equipamento" name="equipamento" disabled class="form-control" value="<?= isset($dados) ? 'Identificação: ' . $dados[0]['ident_equip'] . ' / ' . 'Descrição: ' . $dados[0]['desc_equip'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Problema</label>
                                        <textarea id="problema" name="problema" disabled class="form-control"><?= isset($dados) ? $dados[0]['desc_problema'] : '' ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <?php if ($dados[0]['data_atendimento'] != null && $dados[0]['data_encerramento'] == null) { ?>
                                <div class="form-group col-md-12">
                                    <label>Laudo</label>
                                    <textarea name="laudo" id="laudo" class="form-control" placeholder="Digite aqui..."></textarea>
                                </div>

                            <?php } else if (isset($dados[0]['data_encerramento'])) { ?>
                                <div class="form-group col-md-12">
                                    <label>Laudo</label>
                                    <textarea name="laudo" id="laudo" disabled class="form-control" placeholder="Digite aqui..."><?= $dados[0]['laudo_chamado'] ?></textarea>
                                </div>
                            <?php } ?>

                            <?php if ($dados[0]['data_atendimento'] == null) { ?>
                                <button class="btn btn-success" name="btn_atender" id="btn_atender"> Atender </button>
                            <?php } else if (isset($dados[0]['data_atendimento']) && $dados[0]['data_encerramento'] == null) { ?>
                                <button class="btn btn-success" name="btn_finalizar" id="btn_finalizar" onclick="return ValidarTela(21)"> Finalizar </button>
                            <?php } else { ?>
                            <center><i>Encerrado no dia <?= UtilCTRL::DataExibir($dados[0]['data_encerramento']) . ' às ' . $dados[0]['hora_encerramento'] ?></i></center>
                            <?php } ?>

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