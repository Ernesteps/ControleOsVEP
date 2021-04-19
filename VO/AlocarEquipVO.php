<?php

    class AlocarEquipVO{
        private $idalocar_equip;
        private $data_alocar;
        private $hora_alocar;
        private $data_remover;
        private $hora_remover;
        private $sit_alocar;
        private $idSetor;
        private $idEquipamento;

        public function setIdalocar_equip($id){
            $this->idalocar_equip = $id;
        }

        public function getIdalocar_equip(){
            return $this->idalocar_equip;
        }

        public function setData_alocar($data_alocar){
            $this->data_alocar = $data_alocar;
        }

        public function getData_alocar(){
            return $this->data_alocar;
        }

        public function setHora_alocar($hora_alocar){
            $this->hora_alocar = $hora_alocar;
        }

        public function getHora_alocar(){
            return $this->hora_alocar;
        }

        public function setData_remover($data_remover){
            $this->data_remover = $data_remover;
        }

        public function getData_remover(){
            return $this->data_remover;
        }

        public function setHora_remover($hora_remover){
            $this->hora_remover = $hora_remover;
        }

        public function getHora_remover(){
            return $this->hora_remover;
        }
        
        public function setSit_alocar($sit_alocar){
            $this->sit_alocar = $sit_alocar;
        }

        public function getSit_alocar(){
            return $this->sit_alocar;
        }

        public function setId_setor($idSetor){
            $this->idSetor = $idSetor;
        }

        public function getId_Setor(){
            return $this->idSetor;
        }

        public function setId_Equipamento($idEquipamento){
            $this->idEquipamento = $idEquipamento;
        }

        public function getId_Equipamento(){
            return $this->idEquipamento;
        }
    }