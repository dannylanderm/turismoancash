<?php

	class lugarturistico {

		var $lug_id;
		var $nombre;
		var $tipolug_id;
		var $latitud_geo;
		var $longitud_geo;
		var $altitud;
		var $tamanio_area;
		var $foto;
		var $descripcion;
		var $ubig_id;
		var $direccion_ref;
		var $tipoing_id;
		var $calificacion;
		var $situacion;
		var $resenia;
		var $fecha_reg;
		var $estado;

		public function getLugID() {
			return $this->lug_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getTipolugID() {
			return $this->tipolug_id;
		}
		public function getLatitudGeo() {
			return $this->latitud_geo;
		}
		public function getLongitudGeo() {
			return $this->longitud_geo;
		}
		public function getAltitud() {
			return $this->altitud;
		}
		public function getTamanioArea() {
			return $this->tamanio_area;
		}
		public function getFoto() {
			return $this->foto;
		}
		public function getDescripcion() {
			return $this->descripcion;
		}
		public function getUbigID() {
			return $this->ubig_id;
		}
		public function getDireccionRef() {
			return $this->direccion_ref;
		}
		public function getTipoingID() {
			return $this->tipoing_id;
		}
		public function getCalificacion() {
			return $this->calificacion;
		}
		public function getSituacion() {
			return $this->situacion;
		}
		public function getResenia() {
			return $this->resenia;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setLugID($lug_id) {
			$this->lug_id = $lug_id;
		}
		public function setNombre($lug_nombre) {
			$this->nombre = $lug_nombre;
		}
		public function setTipolugID($lug_tipolug_id) {
			$this->tipolug_id = $lug_tipolug_id;
		}
		public function setLatitudGeo($lug_latitud_geo) {
			$this->latitud_geo = $lug_latitud_geo;
		}
		public function setLongitudGeo($lug_longitud_geo) {
			$this->longitud_geo = $lug_longitud_geo;
		}
		public function setAltitud($lug_altitud) {
			$this->altitud = $lug_altitud;
		}
		public function setTamanioArea($lug_tamanio_area) {
			$this->tamanio_area = $lug_tamanio_area;
		}
		public function setFoto($lug_foto) {
			$this->foto = $lug_foto;
		}
		public function setDescripcion($lug_descripcion) {
			$this->descripcion = $lug_descripcion;
		}
		public function setUbigID($lug_ubig_id) {
			$this->ubig_id = $lug_ubig_id;
		}
		public function setDireccionRef($lug_direccion_ref) {
			$this->direccion_ref = $lug_direccion_ref;
		}
		public function setTipoingID($lug_tipoing_id) {
			$this->tipoing_id = $lug_tipoing_id;
		}
		public function setCalificacion($lug_calificacion) {
			$this->calificacion = $lug_calificacion;
		}
		public function setSituacion($lug_situacion) {
			$this->situacion = $lug_situacion;
		}
		public function setResenia($lug_resenia) {
			$this->resenia = $lug_resenia;
		}
		public function setFechaReg($lug_fecha_reg) {
			$this->fecha_reg = $lug_fecha_reg;
		}
		public function setEstado($lug_estado) {
			$this->estado = $lug_estado;
		}
	}
