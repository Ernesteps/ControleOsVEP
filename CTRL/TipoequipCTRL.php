<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/TipoequipDAO.php';
require_once 'UtilCTRL.php';

class TipoequipCTRL
{
    public function InserirTipoequipCTRL(TipoVO $vo)
    {
        if ($vo->getNome() == '') {
            return 0;
        }
        $dao = new TipoDAO();
        return $dao->InserirTipoDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function AlterarTipoCTRL(TipoVO $vo)
    {
        if ($vo->getNome() == '') {
            return 0;
        }
        $dao = new TipoDAO();
        return $dao->AlterarTipoDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function ConsultarTipoCTRL(){
        $dao = new TipoDAO();
        return $dao->ConsultarTipoDAO();
    }

    public function ExcluirTipoCTRL($idTipo){
        $dao = new TipoDAO();
        return $dao->ExcluirTipoDAO($idTipo, UtilCTRL::CodigoUserLogado());
    }
}
