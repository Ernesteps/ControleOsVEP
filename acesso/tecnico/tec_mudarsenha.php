<?php

require_once '../../CTRL/Tec_MudarsenhaCTRL.php';
require_once '../../VO/TecnicoVO.php';

//isset (Se existe) $_POST é vetorial []
if (isset($_POST['btn_gravar'])) {

    $vo = new TecnicoVO();
    $ctrl = new Tec_MudarsenhaCTRL();

    $vo->setSenha($_POST['nova_senha']);

    $ret = $ctrl->InserirTec_MudarsenhaCTRL($vo);
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
                            <h1>Modifique sua senha</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Mudar Senha</li>
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
                        <h3 class="card-title">Sempre opte em senhas com mais de 6 caracteres</h3>

                    </div>
                    <div class="card-body">

                        <form method="post" action="tec_mudarsenha.php">

                            <div class="form-group">
                                <label>Digite sua senha atual</label>
                                <input type="password" name="senha_atual" id="senha_atual" class="form-control" placeholder="Digite aqui...">
                            </div>

                            <div class="form-group">
                                <label>Digite uma nova senha</label>
                                <input type="password" name="nova_senha" id="nova_senha" class="form-control" placeholder="Digite aqui...">
                            </div>

                            <div class="form-group">
                                <label>Repita sua nova senha</label>
                                <input type="password" name="repitir_nova_senha" id="repitir_nova_senha" class="form-control" placeholder="Digite aqui...">
                            </div>

                            <button class="btn btn-success" name="btn_gravar" onclick="return ValidarTela(12)"> Gravar </button>

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