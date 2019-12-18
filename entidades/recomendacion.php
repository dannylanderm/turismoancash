<?php

	class recomendacion {

		var $rec_id;
		var $lug_id;
		var $tiporec_id;
		var $descripcion;
		var $estado;

		public function getRecID() {
			return $this->rec_id;
		}
		public function getLugID() {
			return $this->lug_id;
		}
		public function getTiporecID() {
			return $this->tiporec_id;
		}
		public function getDescripcion() {
			return $this->descripcion;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setRecID($rec_id) {
			$this->rec_id = $rec_id;
		}
		public function setLugID($rec_lug_id) {
			$this->lug_id = $rec_lug_id;
		}
		public function setTiporecID($rec_tiporec_id) {
			$this->tiporec_id = $rec_tiporec_id;
		}
		public function setDescripcion($rec_descripcion) {
			$this->descripcion = $rec_descripcion;
		}
		public function setEstado($rec_estado) {
			$this->estado = $rec_estado;
		}
	}
