<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/CTRL/UtilCTRL.php';

    Class TipoVO{
        private $idTipo;
        private $nome;

        public function setId_Tipo($id){
            $this->idTipo = trim($id);
        }
        public function getId_Tipo(){
            return $this->idTipo;
        }

        public function setNome($nome){
            $this->nome = UtilCTRL::TirarCaracteresEspeciais($nome);
        }
        public function getNome(){
            return $this->nome;
        }   
    }