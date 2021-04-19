<?php

    class EquipamentoVO{
        private $idEquipamento;
        private $ident_equip;
        private $desc_equip;
        private $idModelo;
        private $idTipo;
        private $idusuario;

        public function setId_Equipamento($id){
            $this->idEquipamento = $id;
        }

        public function getId_Equipamento(){
            return $this->idEquipamento;
        }

        public function setIdent_Equip($ident_equip){
            $this->ident_equip = trim($ident_equip);
        }

        public function getIdent_Equip(){
            return $this->ident_equip;
        }

        public function setDesc_Equip($desc_equip){
            $this->desc_equip = trim($desc_equip);
        }

        public function getDesc_Equip(){
            return $this->desc_equip;
        }

        public function setId_Modelo($idModelo){
            $this->idModelo = $idModelo;
        }

        public function getId_Modelo(){
            return $this->idModelo;
        }

        public function setId_Tipo($idTipo){
            $this->idTipo = $idTipo;
        }

        public function getId_Tipo(){
            return $this->idTipo;
        }
        
        public function setId_Usuario($idusuario){
            $this->idusuario = $idusuario;
        }

        public function getId_Usuario(){
            return $this->idusuario;
        }
    }