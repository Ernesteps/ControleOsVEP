<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/ChamadoDAO.php';
require_once 'UtilCTRL.php';

class ChamadoCTRL
{
    public function CarregarEquipamentosSetorCTRL()
    {
        $dao = new ChamadoDAO();
        return $dao->CarregarEquipamentosSetorDAO(UtilCTRL::SetorUserLogado(), 1);
    }

    public function InserirChamadoFuncCTRL(ChamadoVO $vo, $idAlocar)
    {
        if ($vo->getId_Equipamento() == '' || $vo->getDesc_Problema() == '') {
            return 0;
        }

        $vo->setData_Chamado(UtilCTRL::DataAtual());
        $vo->setHora_Chamado(UtilCTRL::HoraAtual());


        $dao = new ChamadoDAO();
        return $dao->InserirChamadoDAOFunc($vo, UtilCTRL::CodigoUserLogado(), $idAlocar);
    }

    public function FiltrarChamadoSetorCTRL($FiltrarSit)
    {
        $dao = new ChamadoDAO();
        return $dao->FiltrarChamadoSetorDAO($FiltrarSit, UtilCTRL::SetorUserLogado());
    }

    public function FiltrarChamadosTecCTRL($FiltrarSit)
    {
        $dao = new ChamadoDAO();
        return $dao->FiltrarChamadosTec($FiltrarSit);
    }
}
