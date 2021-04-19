<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/Tec_MudarsenhaDAO.php';

class Tec_MudarsenhaCTRL
{
    public function InserirTec_MudarsenhaCTRL(TecnicoVO $vo)
    {
        if ($vo->getSenha() == '') {
            return 0;
        }
        //Continuar o processo(Outra aula vê isso)
    }
}