<?php
//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/Func_ChamadoDAO.php';

class Func_ChamadoCTRL
{
    public function InserirFunc_ChamadoCTRL(ChamadoVO $vo)
    {
        if ($vo->getId_Equipamento() == '' || $vo->getDesc_Problema() == '') {
            return 0;
        }
        //Continuar o processo(Outra aula vê isso)
    }
}