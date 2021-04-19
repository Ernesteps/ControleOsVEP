<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/CTRL/SetorCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/VO/SetorVO.php';

$ctrl = new SetorCTRL();

if (isset($_POST['nome_setor']) && $_POST['acao'] == 'I') {

    $vo = new SetorVO();
    $nome = $_POST['nome_setor'];
    $vo->setNome($nome);

    $ret = $ctrl->InserirSetorCTRL($vo);
} else if (isset($_POST['acao']) && $_POST['acao'] == 'C') {
    $setores = $ctrl->ConsultarSetorCTRL();
?>
    <table class="table table-bordered" id="tabSetores">
        <thead>
            <tr>
                <th>Nome do Setor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>

            <?php for ($i = 0; $i < count($setores); $i++) { ?>
                <tr>
                    <td><?= $setores[$i]['nome_setor'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosSetorAlterar('<?= $setores[$i]['id_setor'] ?>','<?= $setores[$i]['nome_setor'] ?>')">Alterar</a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $setores[$i]['id_setor'] ?>','<?= $setores[$i]['nome_setor'] ?>')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>