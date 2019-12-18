<?php

	class tipoobjetoturistico {

		var $tipoobj_id;
		var $nombre;
		var $estado;

		public function getTipoobjID() {
			return $this->tipoobj_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTipoobjID($tipoobj_id) {
			$this->tipoobj_id = $tipoobj_id;
		}
		public function setNombre($tipoobj_nombre) {
			$this->nombre = $tipoobj_nombre;
		}
		public function setEstado($tipoobj_estado) {
			$this->estado = $tipoobj_estado;
		}
	}
