<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/ModeloDAO.php';
require_once 'UtilCTRL.php';

class ModeloCTRL
{
    public function InserirModeloCTRL(ModeloVO $vo)
    {
        if ($vo->getNome() == '') {
            return 0;
        }
        $dao = new ModeloDAO();
        return $dao->InserirModeloDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function AlterarModeloCTRL(ModeloVO $vo)
    {
        if ($vo->getNome() == '') {
            return 0;
        }
        $dao = new ModeloDAO();
        return $dao->AlterarModeloDAO($vo, UtilCTRL::CodigoUserLogado());
    }

    public function ConsultarModeloCTRL(){
        $dao = new ModeloDAO();
        return $dao->ConsultarModeloDAO();
    }

    public function ExcluirModeloCTRL($idModelo){
        $dao = new ModeloDAO();
        return $dao->ExcluirModeloDAO($idModelo, UtilCTRL::CodigoUserLogado());
    }
}
