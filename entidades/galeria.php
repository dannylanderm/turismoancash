<?php

	class galeria {

		var $gal_id;
		var $lug_id;
		var $foto;
		var $foto_descripcion;
		var $estado;

		public function getGalID() {
			return $this->gal_id;
		}
		public function getLugID() {
			return $this->lug_id;
		}
		public function getFoto() {
			return $this->foto;
		}
		public function getFotoDescripcion() {
			return $this->foto_descripcion;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setGalID($gal_id) {
			$this->gal_id = $gal_id;
		}
		public function setLugID($gal_lug_id) {
			$this->lug_id = $gal_lug_id;
		}
		public function setFoto($gal_foto) {
			$this->foto = $gal_foto;
		}
		public function setFotoDescripcion($gal_foto_descripcion) {
			$this->foto_descripcion = $gal_foto_descripcion;
		}
		public function setEstado($gal_estado) {
			$this->estado = $gal_estado;
		}
	}
