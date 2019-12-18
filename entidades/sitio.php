<?php

	class sitio {

		var $sitio_id;
		var $nombre;
		var $tipositio_id;
		var $latitud_geo;
		var $longitud_geo;
		var $celular;
		var $telefono;
		var $webpage;
		var $ubig_id;
		var $direccion;
		var $calificacion;
		var $situacion;
		var $estado;

		public function getSitioID() {
			return $this->sitio_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getTipositioID() {
			return $this->tipositio_id;
		}
		public function getLatitudGeo() {
			return $this->latitud_geo;
		}
		public function getLongitudGeo() {
			return $this->longitud_geo;
		}
		public function getCelular() {
			return $this->celular;
		}
		public function getTelefono() {
			return $this->telefono;
		}
		public function getWebpage() {
			return $this->webpage;
		}
		public function getUbigID() {
			return $this->ubig_id;
		}
		public function getDireccion() {
			return $this->direccion;
		}
		public function getCalificacion() {
			return $this->calificacion;
		}
		public function getSituacion() {
			return $this->situacion;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setSitioID($sitio_id) {
			$this->sitio_id = $sitio_id;
		}
		public function setNombre($sitio_nombre) {
			$this->nombre = $sitio_nombre;
		}
		public function setTipositioID($sitio_tipositio_id) {
			$this->tipositio_id = $sitio_tipositio_id;
		}
		public function setLatitudGeo($sitio_latitud_geo) {
			$this->latitud_geo = $sitio_latitud_geo;
		}
		public function setLongitudGeo($sitio_longitud_geo) {
			$this->longitud_geo = $sitio_longitud_geo;
		}
		public function setCelular($sitio_celular) {
			$this->celular = $sitio_celular;
		}
		public function setTelefono($sitio_telefono) {
			$this->telefono = $sitio_telefono;
		}
		public function setWebpage($sitio_webpage) {
			$this->webpage = $sitio_webpage;
		}
		public function setUbigID($sitio_ubig_id) {
			$this->ubig_id = $sitio_ubig_id;
		}
		public function setDireccion($sitio_direccion) {
			$this->direccion = $sitio_direccion;
		}
		public function setCalificacion($sitio_calificacion) {
			$this->calificacion = $sitio_calificacion;
		}
		public function setSituacion($sitio_situacion) {
			$this->situacion = $sitio_situacion;
		}
		public function setEstado($sitio_estado) {
			$this->estado = $sitio_estado;
		}
	}
