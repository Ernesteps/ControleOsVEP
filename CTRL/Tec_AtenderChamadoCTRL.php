<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/Tec_AtenderChamadoDAO.php';

class AtenderChamadoCTRL
{
    public function InserirAtenderChamadoCTRL(ChamadoVO $vo)
    {
        if ($vo->getData_Chamado() == '' || $vo->getId_Equipamento() == '' || $vo->getLaudo_Chamado() == '' || $vo->getId_Usuario_Tec() || $vo->getId_Usuario_Fun()) {
            return 0;
        }
    }
            //Continuar o processo(Outra aula vê isso)
}