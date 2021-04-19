<?php

    Class UsuarioVO{
        private $idUser;
        private $tipo;
        private $nome;
        private $cpf;
        private $senha;
        private $status;
        private $dtCad;
        private $rSenha;

        public function setIdUser($id){
            $this->idUser = $id;
        }
        public function getIdUser(){
            return $this->idUser;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        public function getTipo(){
            return $this->tipo;
        }

        public function setNome($nome){
            $this->nome = trim($nome);
        }
        public function getNome(){
            return $this->nome;
        }

        public function setCPF($cpf){
            $this->cpf = trim($cpf);
        }
        public function getCPF(){
            return $this->cpf;
        }

        public function setSenha($senha){
            $this->senha = trim($senha);
        }
        public function getSenha(){
            return $this->senha;
        }

        public function setStatus($status){
            $this->status = $status;
        }
        public function getStatus(){
            return $this->status;
        }

        public function setDtCad($dtCad){
            $this->dtCad = $dtCad;
        }
        public function getDtCad(){
            return $this->dtCad;
        }

        public function setrSenha($rSenha){
            $this->rSenha = $rSenha;
        }
        public function getrSenha(){
            return $this->rSenha;
        }
    }