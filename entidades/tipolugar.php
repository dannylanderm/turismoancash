<?php

	class tipolugar {

		var $tipolug_id;
		var $nombre;
		var $catlug_id;
		var $estado;

		public function getTipolugID() {
			return $this->tipolug_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getCatlugID() {
			return $this->catlug_id;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTipolugID($tipolug_id) {
			$this->tipolug_id = $tipolug_id;
		}
		public function setNombre($tipolug_nombre) {
			$this->nombre = $tipolug_nombre;
		}
		public function setCatlugID($tipolug_catlug_id) {
			$this->catlug_id = $tipolug_catlug_id;
		}
		public function setEstado($tipolug_estado) {
			$this->estado = $tipolug_estado;
		}
	}
