<?php
require_once '_vertipo_adm.php';
require_once '../../CTRL/ChamadoCTRL.php';
use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';

if (isset($_GET['sit'])) {
    $sit = $_GET['sit'];

    $ctrl_call = new ChamadoCTRL();
    $sit = $_GET['sit'];
    $chs = $ctrl_call->FiltrarChamadosTecCTRL(null, $sit);

    if(count($chs) == 0){
        header('location: adm_verchamados.php?ret=8');
        exit;
    }

    $inicio_tabela = '<table style="color: red">
                        <thead>
                        <tr>
                            <th>Data da abertura</th>
                            <th>Funcionário</th>
                            <th>Equipamento</th>
                            <th>Problema</th>
                            <th>Setor</th>
                            <th>Situação</th>
                        </tr>
                        </thead>
                        <tbody>';

    $linha_tabela = '';

    foreach ($chs as $item) { 
        $linha_tabela .= '<tr>
                            <td>' . UtilCTRL::DataExibir($item['data_chamado']) . ' às ' . $item['hora_chamado'] . '</td>
                            <td>' . $item['nome_funcionario'] . '</td>
                            <td>' . $item['ident_equip'] . ' / ' . $item['desc_equip'] . '</td>
                            <td>' . $item['desc_problema'] . '</td>
                            <td>' . $item['nome_setor'] . '</td>
                            <td>' . UtilCTRL::StuacaoChamado($item['data_atendimento'], $item['data_encerramento']) . '</td>
                          </tr>';
      } 

    $fim_tabela = '</tbody></table>';

    $tabela_resultado = $inicio_tabela . $linha_tabela . $fim_tabela;
    $domPdf = new Dompdf();
    $domPdf->loadHtml($tabela_resultado);
    $domPdf->render();
    $domPdf->stream('ver_chamados_' . UtilCTRL::DataAtual() . '.pdf', array('Attachment' => false));

} else {
    header('location: adm_verchamados.php');
    exit;
}

?>