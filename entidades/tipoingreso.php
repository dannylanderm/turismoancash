<?php

	class tipoingreso {

		var $tipoing_id;
		var $nombre;
		var $estado;

		public function getTipoingID() {
			return $this->tipoing_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTipoingID($tipoing_id) {
			$this->tipoing_id = $tipoing_id;
		}
		public function setNombre($tipoing_nombre) {
			$this->nombre = $tipoing_nombre;
		}
		public function setEstado($tipoing_estado) {
			$this->estado = $tipoing_estado;
		}
	}
