<?php

    require_once 'UsuarioVO.php';

    Class FuncionarioVO extends UsuarioVO{
        private $email_fun;
        private $tel_fun;
        private $endereco_fun;
        private $idSetor;

        public function setEmail_fun($email_fun){
            $this->email_fun = trim($email_fun);
        }
        public function getEmail_fun(){
            return $this->email_fun;
        }

        public function setTel_fun($tel_fun){
            $this->tel_fun = trim($tel_fun);
        }
        public function getTel_fun(){
            return $this->tel_fun;
        }

        public function setEndereco_fun($endereco_fun){
            $this->endereco_fun = trim($endereco_fun);
        }
        public function getEndereco_fun(){
            return $this->endereco_fun;
        }

        public function setIdSetor($idSetor){
            $this->idSetor = $idSetor;
        }
        public function getIdSetor(){
            return $this->idSetor;
        }
    }