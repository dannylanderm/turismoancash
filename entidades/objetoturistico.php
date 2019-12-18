<?php

	class objetoturistico {

		var $obj_id;
		var $nombre;
		var $tipoobj_id;
		var $foto;
		var $comentario;
		var $fecha_datacion;
		var $lug_id;
		var $situacion;
		var $estado;

		public function getObjID() {
			return $this->obj_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getTipoobjID() {
			return $this->tipoobj_id;
		}
		public function getFoto() {
			return $this->foto;
		}
		public function getComentario() {
			return $this->comentario;
		}
		public function getFechaDatacion() {
			return $this->fecha_datacion;
		}
		public function getLugID() {
			return $this->lug_id;
		}
		public function getSituacion() {
			return $this->situacion;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setObjID($obj_id) {
			$this->obj_id = $obj_id;
		}
		public function setNombre($obj_nombre) {
			$this->nombre = $obj_nombre;
		}
		public function setTipoobjID($obj_tipoobj_id) {
			$this->tipoobj_id = $obj_tipoobj_id;
		}
		public function setFoto($obj_foto) {
			$this->foto = $obj_foto;
		}
		public function setComentario($obj_comentario) {
			$this->comentario = $obj_comentario;
		}
		public function setFechaDatacion($obj_fecha_datacion) {
			$this->fecha_datacion = $obj_fecha_datacion;
		}
		public function setLugID($obj_lug_id) {
			$this->lug_id = $obj_lug_id;
		}
		public function setSituacion($obj_situacion) {
			$this->situacion = $obj_situacion;
		}
		public function setEstado($obj_estado) {
			$this->estado = $obj_estado;
		}
	}
