<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/Func_MeusdadosDAO.php';

class Func_MeusdadosCTRL
{
    public function InserirFunc_MeusdadosCTRL(FuncionarioVO $vo)
    {
        if ($vo->getNome() == '' || $vo->getEmail_fun() == '' || $vo->getTel_fun() == '' || $vo->getEndereco_fun() == '') {
            return 0;
        }
        //Continuar o processo(Outra aula vê isso)
    }
}