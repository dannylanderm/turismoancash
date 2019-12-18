<?php

	class rol {

		var $rol_id;
		var $nombre;
		var $estado;

		public function getRolID() {
			return $this->rol_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setRolID($rol_id) {
			$this->rol_id = $rol_id;
		}
		public function setNombre($rol_nombre) {
			$this->nombre = $rol_nombre;
		}
		public function setEstado($rol_estado) {
			$this->estado = $rol_estado;
		}
	}
