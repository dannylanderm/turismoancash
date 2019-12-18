<?php

	class tipoactividad {

		var $tipoactiv_id;
		var $nombre;
		var $estado;

		public function getTipoactivID() {
			return $this->tipoactiv_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTipoactivID($tipoactiv_id) {
			$this->tipoactiv_id = $tipoactiv_id;
		}
		public function setNombre($tipoactiv_nombre) {
			$this->nombre = $tipoactiv_nombre;
		}
		public function setEstado($tipoactiv_estado) {
			$this->estado = $tipoactiv_estado;
		}
	}
