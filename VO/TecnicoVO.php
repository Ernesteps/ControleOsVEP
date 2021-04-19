<?php

    require_once 'UsuarioVO.php';

    Class TecnicoVO extends UsuarioVO{
        private $email_tec;
        private $tel_tec;
        private $endereco_tec;

        public function setEmail_tec($email_tec){
            $this->email_tec = trim($email_tec);
        }
        public function getEmail_tec(){
            return $this->email_tec;
        }

        public function setTel_tec($tel_tec){
            $this->tel_tec = trim($tel_tec);
        }
        public function getTel_tec(){
            return $this->tel_tec;
        }

        public function setEndereco_tec($endereco_tec){
            $this->endereco_tec = trim($endereco_tec);
        }
        public function getEndereco_tec(){
            return $this->endereco_tec;
        }
    }
