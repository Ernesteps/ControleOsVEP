<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/EquipamentoDAO.php';
require_once 'UtilCTRL.php';

class EquipamentoCTRL
{
    public function FiltrarAlocado($idSetor)
    {
        $dao = new EquipamentoDAO();
        return $dao->FiltrarAlocado($idSetor);
    }

    public function AlocarEquipamento(AlocarEquipVO $vo)
    {
        if ($vo->getId_Equipamento() == '' || $vo->getId_Setor() == '') {
            return 0;
        }

        $vo->setSit_alocar(1);
        $vo->setData_alocar(UtilCTRL::DataAtual());
        $vo->setHora_alocar(UtilCTRL::HoraAtual());

        $dao = new EquipamentoDAO();
        return $dao->AlocarEquipamento($vo, UtilCTRL::CodigoUserLogado());
    }

    public function FiltrarEquipamentosNaoAlocado()
    {
        $dao = new EquipamentoDAO();
        return $dao->FiltrarEquipamentosNaoAlocado();
    }

    public function InserirEquipamentoCTRL(EquipamentoVO $vo)
    {
        if ($vo->getId_Tipo() == '' || $vo->getId_Modelo() == '' || $vo->getIdent_Equip() == '' || $vo->getDesc_Equip() == '') {
            return 0;
        }
        $vo->setId_Usuario(UtilCTRL::CodigoUserLogado());

        $dao = new EquipamentoDAO();
        return $dao->InserirEquipamentoDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function AlterarEquipamento(EquipamentoVO $vo)
    {
        if ($vo->getId_Tipo() == '' || $vo->getId_Modelo() == '' || $vo->getIdent_Equip() == '' || $vo->getDesc_Equip() == '') {
            return 0;
        }

        $dao = new EquipamentoDAO();
        return $dao->AlterarEquipamento($vo, UtilCTRL::CodigoUserLogado());
    }

    public function PesquisarEquipamentoCTRL($idTipo)
    {
        if ($idTipo == '') {
            return 0;
        }
        $dao = new EquipamentoDAO();
        return $dao->PesquisarEquipamentoTipo($idTipo);
    }

    public function DetalharEquipamento($idEquipamento)
    {
        $dao = new EquipamentoDAO();
        return $dao->DetalharEquipamento($idEquipamento);
    }

    public function ExcluirEquipamentoCTRL($idEquipamento)
    {
        $dao = new EquipamentoDAO();
        return $dao->ExcluirEquipamentoDAO($idEquipamento);
    }

    public function FiltrarEquipamentosNaoAlocadoCTRL()
    {
        $dao = new EquipamentoDAO();
        return $dao->FiltrarEquipamentosNaoAlocado();
    }

    public function RemoverEquipamento(AlocarEquipVO $vo)
    {
        $vo->setSit_alocar(2);
        $vo->setData_remover(UtilCTRL::DataAtual());
        $vo->setHora_remover(UtilCTRL::HoraAtual());


        $dao = new EquipamentoDAO();
        return $dao->RemoverEquipamento($vo, UtilCTRL::CodigoUserLogado());
    }
}
