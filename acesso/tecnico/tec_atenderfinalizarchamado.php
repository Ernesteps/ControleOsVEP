<?php

require_once '../../CTRL/Tec_AtenderChamadoCTRL.php';
require_once '../../VO/ChamadoVO.php';

//isset (Se existe) $_POST é vetorial []
if (isset($_POST['btn_gravar'])) {

  $vo = new ChamadoVO();
  $ctrl = new AtenderChamadoCTRL();

  $vo->setData_Chamado($_POST['data']);
  $vo->setId_Usuario_Fun($_POST['funcionario']);
  $vo->setId_Equipamento($_POST['equipamento']);
  $vo->setLaudo_Chamado($_POST['laudo']);

  $ret = $ctrl->InserirAtenderChamadoCTRL($vo);
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
                            <h1>Faça o atendimento e a finalização do chamado aqui</h1>
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
                        <h3 class="card-title">Escreva de uma forma clara o problema do equipamento</h3>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Data</label>
                                    <input name="data" id="data" class="form-control" placeholder="Digite aqui...">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Funcionário</label>
                                    <input name="funcionario" id="funcionario" class="form-control" placeholder="Digite aqui...">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Setor</label>
                                    <input name="setor" id="setor" class="form-control" placeholder="Digite aqui...">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Equipamento</label>
                                    <input name="equipamento" id="equipamento" class="form-control" placeholder="Digite aqui...">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Laudo</label>
                            <textarea type="Text" name="laudo" id="laudo" class="form-control" placeholder="Digite aqui..."></textarea>
                        </div>

                        <button class="btn btn-success" name="btn_gravar" onclick="return ValidarTela(10)"> Gravar </button>

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

        ?>


        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</body>

</html>