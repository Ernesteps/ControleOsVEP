<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/AlocarequipDAO.php';

class AlocarequipCTRL
{
    public function InserirAlocarequipCTRL(AlocarEquipVO $vo)
    {
        if ($vo->getId_Setor() == '' || $vo->getId_Equipamento() == '') {
            return 0;
        }
        //Continuar o processo(Outra aula vê isso)
    }
}