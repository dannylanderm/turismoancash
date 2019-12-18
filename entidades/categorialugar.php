<?php

	class categorialugar {

		var $catlug_id;
		var $nombre;
		var $descripcion;
		var $estado;

		public function getCatlugID() {
			return $this->catlug_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getDescripcion() {
			return $this->descripcion;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setCatlugID($catlug_id) {
			$this->catlug_id = $catlug_id;
		}
		public function setNombre($catlug_nombre) {
			$this->nombre = $catlug_nombre;
		}
		public function setDescripcion($catlug_descripcion) {
			$this->descripcion = $catlug_descripcion;
		}
		public function setEstado($catlug_estado) {
			$this->estado = $catlug_estado;
		}
	}
