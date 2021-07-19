<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/ChamadoDAO.php';
require_once 'UtilCTRL.php';

class ChamadoCTRL
{
    public function CarregarGraficoInicial()
    {
        $dao = new ChamadoDAO();
        return $dao->CarregarGraficoInicial();
    }

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

    public function FiltrarChamadosTecCTRL($cod, $FiltrarSit)
    {
            $dao = new ChamadoDAO();
            return $dao->FiltrarChamadosTec($cod, $FiltrarSit);
    }

    public function AtenderChamadoCTRL(ChamadoVO $vo)
    {
        $vo->setData_Atendimento(UtilCTRL::DataAtual());
        $vo->setHora_Atendimento(UtilCTRL::HoraAtual());

        $dao = new ChamadoDAO();
        return $dao->AtenderChamadoDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function EncerrarChamadoCTRL(ChamadoVO $vo)
    {
        $vo->setData_Encerramento(UtilCTRL::DataAtual());
        $vo->setHora_Encerramento(UtilCTRL::HoraAtual());

        $dao = new ChamadoDAO();
        return $dao->EncerrarChamadoDAO($vo, UtilCTRL::CodigoUserLogado());
    }
}
