<?php

    class SetorVO{
        private $idSetor;
        private $nome;

        public function setIdSetor($id){
            $this->idSetor = $id;
        }
        public function getIdSetor(){
            return $this->idSetor;
        }

        public function setNome($nome){
            $this->nome = trim($nome);
        }
        public function getNome(){
            return $this->nome;
        }
    }