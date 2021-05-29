<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../VO/UsuarioVO.php';
require_once '../../CTRL/UtilCTRL.php';

$ctrl = new UsuarioCTRL();
$dados = $ctrl->DetalharUsuarioCTRL();

if (isset($_POST['btn_alterar'])) {
    if ($_POST['senha_nova'] == $_POST['repitir_senha_nova']) {
        $vo = new UsuarioVO();

        $vo->setIdUser($dados[0]['id_usuario']);
        $vo->setSenha($_POST['repitir_senha_nova']);
        $ret = $ctrl->AlterarSenhaCTRL($vo);
    } else {
        $ret = 3;
    }
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

                            <div class="form-group" id="divSenhaAtual" name="divSenhaAtual">
                                <label>Digite sua senha atual</label>
                                <input type="password" name="senha_atual" id="senha_atual" class="form-control" placeholder="Digite aqui...">
                            </div>

                            <input type='button' class="btn btn-secondary" name="btn_verificar" id="btn_verificar" onclick="ValidarSenha(document.getElementById('senha_atual').value, <?= $dados[0]['cpf_usuario'] ?>)" value="Verificar"></input>

                            <div id="SenhaPreenchida" name="SenhaPreenchida" style="display: none;">
                                <div class="form-group">
                                    <label>Digite uma nova senha</label>
                                    <input type="password" name="senha_nova" id="senha_nova" class="form-control" placeholder="Digite aqui...">
                                </div>

                                <div class="form-group">
                                    <label>Repita sua nova senha</label>
                                    <input type="password" name="repitir_senha_nova" id="repitir_senha_nova" class="form-control" placeholder="Digite aqui...">
                                </div>

                                <button type='submit' class="btn btn-success" name="btn_alterar" id="btn_alterar" onclick="return ValidarTela(16)"> Alterar </button>
                            </div>


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