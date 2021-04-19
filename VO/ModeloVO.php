<?php

    Class ModeloVO{
        private $idModelo;
        private $nome;

        public function setIdModelo($idModelo){
            $this->idModelo = $idModelo;
        }
        public function getIdModelo(){
            return $this->idModelo;
        }

        public function setNome($nome){
            $this->nome = trim($nome);
        }
        public function getNome(){
            return $this->nome;
        }
    }