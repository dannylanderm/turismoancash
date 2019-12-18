<?php

	class tiporecomendacion {

		var $tiporec_id;
		var $nombre;
		var $estado;

		public function getTiporecID() {
			return $this->tiporec_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTiporecID($tiporec_id) {
			$this->tiporec_id = $tiporec_id;
		}
		public function setNombre($tiporec_nombre) {
			$this->nombre = $tiporec_nombre;
		}
		public function setEstado($tiporec_estado) {
			$this->estado = $tiporec_estado;
		}
	}
