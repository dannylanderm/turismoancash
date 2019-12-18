<?php

	class persona {

		var $pers_id;
		var $ap_paterno;
		var $ap_materno;
		var $nombres;
		var $correo;
		var $estado;

		public function getPersID() {
			return $this->pers_id;
		}
		public function getApPaterno() {
			return $this->ap_paterno;
		}
		public function getApMaterno() {
			return $this->ap_materno;
		}
		public function getNombres() {
			return $this->nombres;
		}
		public function getCorreo() {
			return $this->correo;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setPersID($pers_id) {
			$this->pers_id = $pers_id;
		}
		public function setApPaterno($pers_ap_paterno) {
			$this->ap_paterno = $pers_ap_paterno;
		}
		public function setApMaterno($pers_ap_materno) {
			$this->ap_materno = $pers_ap_materno;
		}
		public function setNombres($pers_nombres) {
			$this->nombres = $pers_nombres;
		}
		public function setCorreo($pers_correo) {
			$this->correo = $pers_correo;
		}
		public function setEstado($pers_estado) {
			$this->estado = $pers_estado;
		}
	}
