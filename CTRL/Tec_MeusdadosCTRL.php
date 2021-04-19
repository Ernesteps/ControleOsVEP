<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/Tec_MeusdadosDAO.php';

class Tec_MeusdadosCTRL
{
    public function InserirTec_MeusdadosCTRL(TecnicoVO $vo)
    {
        if ($vo->getNome() == '' || $vo->getEmail_tec() == '' || $vo->getTel_tec() == '' || $vo->getEndereco_tec() == '') {
            return 0;
        }
        //Continuar o processo(Outra aula vê isso)
    }
}