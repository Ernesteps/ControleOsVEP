<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/ChamadoDAO.php';
require_once 'UtilCTRL.php';

class ChamadoCTRL
{
    public function CarregarEquipamentosSetorCTRL($idSetorLogado, $sit)
    {
        $dao = new ChamadoDAO();
        return $dao->CarregarEquipamentosSetorDAO($idSetorLogado, $sit);
    }

    public function InserirChamadoFuncCTRL(ChamadoVO $vo)
    {
        if ($vo->getId_Equipamento() == '' || $vo->getDesc_Problema() == '') {
            return 0;
        }

        $vo->setData_Chamado(UtilCTRL::DataAtual());
        $vo->setHora_Chamado(UtilCTRL::HoraAtual());

        $dao = new ChamadoDAO();
        return $dao->InserirChamadoDAOFunc($vo, UtilCTRL::CodigoUserLogado());
    }
}
