<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/CTRL/ModeloCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/VO/ModeloVO.php';

$ctrl = new ModeloCTRL();

if (isset($_POST['nome_modelo']) && $_POST['acao'] == 'I') {

    $vo = new ModeloVO();
    $nome = $_POST['nome_modelo'];
    $vo->setNome($nome);

    $ret = $ctrl->InserirModeloCTRL($vo);
} else if (isset($_POST['acao']) && $_POST['acao'] == 'C') {
    $modelos = $ctrl->ConsultarModeloCTRL();
?>
    <table class="table table-bordered" id="tabModelos">
        <thead>
            <tr>
                <th>Nome do modelo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>

            <?php for ($i = 0; $i < count($modelos); $i++) { ?>
                <tr>
                    <td><?= $modelos[$i]['nome_modelo'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosModeloAlterar('<?= $modelos[$i]['id_modelo'] ?>','<?= $modelos[$i]['nome_modelo'] ?>')">Alterar</a> <!-- a href="#" Link que "não faz nada", mas serve pra abrir modal -->
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $modelos[$i]['id_modelo'] ?>','<?= $modelos[$i]['nome_modelo'] ?>')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>