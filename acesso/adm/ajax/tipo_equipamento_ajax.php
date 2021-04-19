<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/CTRL/TipoequipCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/VO/TipoVO.php';

$ctrl = new TipoequipCTRL();

if (isset($_POST['nome_tipo']) && $_POST['acao'] == 'I') {

    $vo = new TipoVO();
    $nome = $_POST['nome_tipo'];
    $vo->setNome($nome);

    $ret = $ctrl->InserirTipoequipCTRL($vo);
} else if (isset($_POST['acao']) && $_POST['acao'] == 'C') {
    $tipos = $ctrl->ConsultarTipoCTRL();
?>
    <table class="table table-bordered" id="tabTipos">
        <thead>
            <tr>
                <th>Nome do Tipo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>

            <?php for ($i = 0; $i < count($tipos); $i++) { ?>
                <tr>
                    <td><?= $tipos[$i]['nome_tipo'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosTipoAlterar('<?= $tipos[$i]['id_tipo'] ?>','<?= $tipos[$i]['nome_tipo'] ?>')">Alterar</a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $tipos[$i]['id_tipo'] ?>','<?= $tipos[$i]['nome_tipo'] ?>')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>