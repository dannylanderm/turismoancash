<?php

	class tipositio {

		var $tipositio_id;
		var $nombre;
		var $estado;

		public function getTipositioID() {
			return $this->tipositio_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTipositioID($tipositio_id) {
			$this->tipositio_id = $tipositio_id;
		}
		public function setNombre($tipositio_nombre) {
			$this->nombre = $tipositio_nombre;
		}
		public function setEstado($tipositio_estado) {
			$this->estado = $tipositio_estado;
		}
	}
