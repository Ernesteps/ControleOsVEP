<?php

    class ChamadoVO{
        private $idChamado;
        private $desc_problema;
        private $data_chamado;
        private $hora_chamado;
        private $data_atendimento;
        private $hora_atendimento;
        private $data_encerramento;
        private $hora_encerramento;
        private $laudo_chamado;
        private $id_Usuario_Fun;
        private $id_Usuario_Tec;
        private $id_Equipamento;

        public function setId_Chamado($idChamado){
            $this->idChamado = $idChamado;
        }
        public function getId_Chamado(){
            return $this->idChamado;
        }

        public function setDesc_problema($desc_problema){
            $this->desc_problema = $desc_problema;
        }
        public function getDesc_Problema(){
            return $this->desc_problema;
        }

        public function setData_Chamado($data_chamado){
            $this->data_chamado = $data_chamado;
        }
        public function getData_Chamado(){
            return $this->data_chamado;
        }

        public function setHora_Chamado($hora_chamado){
            $this->hora_chamado = $hora_chamado;
        }
        public function getHora_chamado(){
            return $this->hora_chamado;
        }

        public function setData_Atendimento($data_atendimento){
            $this->data_atendimento = $data_atendimento;
        }
        public function getData_Atendimento(){
            return $this->data_atendimento;
        }

        public function setHora_Atendimento($hora_atendimento){
            $this->hora_atendimento = $hora_atendimento;
        }
        public function getHora_Atendimento(){
            return $this->hora_atendimento;
        }

        public function setData_Encerramento($data_encerramento){
            $this->data_encerramento = $data_encerramento;
        }
        public function getData_Encerramento(){
            return $this->data_encerramento;
        }

        public function setHora_Encerramento($hora_encerramento){
            $this->hora_encerramento = $hora_encerramento;
        }
        public function getHora_Encerramento(){
            return $this->hora_encerramento;
        }

        public function setLaudo_Chamado($laudo_chamado){
            $this->laudo_chamado = trim($laudo_chamado);
        }
        public function getLaudo_Chamado(){
            return $this->laudo_chamado;
        }

        public function setId_Usuario_Fun($id_Usuario_Fun){
            $this->id_Usuario_Fun = $id_Usuario_Fun;
        }
        public function getId_Usuario_Fun(){
            return $this->id_Usuario_Fun;
        }

        public function setId_Usuario_Tec($id_Usuario_Tec){
            $this->id_Usuario_Tec = $id_Usuario_Tec;
        }
        public function getId_Usuario_Tec(){
            return $this->id_Usuario_Tec;
        }

        public function setId_Equipamento($id_Equipamento){
            $this->id_Equipamento = $id_Equipamento;
        }
        public function getId_Equipamento(){
            return $this->id_Equipamento;
        }
    }