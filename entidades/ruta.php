<?php

	class ruta {

		var $ruta_id;
		var $descripcion;
		var $fecha_reg;
		var $estado;

		public function getRutaID() {
			return $this->ruta_id;
		}
		public function getDescripcion() {
			return $this->descripcion;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setRutaID($ruta_id) {
			$this->ruta_id = $ruta_id;
		}
		public function setDescripcion($ruta_descripcion) {
			$this->descripcion = $ruta_descripcion;
		}
		public function setFechaReg($ruta_fecha_reg) {
			$this->fecha_reg = $ruta_fecha_reg;
		}
		public function setEstado($ruta_estado) {
			$this->estado = $ruta_estado;
		}
	}
