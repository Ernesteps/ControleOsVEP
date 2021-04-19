<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/Func_MudarsenhaDAO.php';

class Func_MudarsenhaCTRL
{
    public function InserirFunc_MudarsenhaCTRL(FuncionarioVO $vo)
    {
        if ($vo->getSenha() == '') {
            return 0;
        }
        //Continuar o processo(Outra aula vê isso)
    }
}