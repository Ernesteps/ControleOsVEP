<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/SetorDAO.php';
require_once 'UtilCTRL.php';

class SetorCTRL
{
    public function InserirSetorCTRL(SetorVO $vo)
    {
        if ($vo->getNome() == '') {
            return 0;
        }
        $dao = new SetorDAO();
        return $dao->InserirSetorDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function AlterarSetorCTRL(SetorVO $vo)
    {
        if ($vo->getNome() == '') {
            return 0;
        }
        $dao = new SetorDAO();
        return $dao->AlterarSetorDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function ConsultarSetorCTRL(){
        $dao = new SetorDAO();
        return $dao->ConsultarSetorDAO();
    }

    public function ExcluirSetorCTRL($idSetor){
        $dao = new SetorDAO();
        return $dao->ExcluirSetorDAO($idSetor, UtilCTRL::CodigoUserLogado());
    }
}
