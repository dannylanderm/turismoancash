<?php

	class usuario {

		var $usu_id;
		var $pers_id;
		var $nombre;
		var $contrasena;
		var $rol_id;
		var $fecha_acceso;
		var $fecha_reg;
		var $estado;

		public function getUsuID() {
			return $this->usu_id;
		}
		public function getPersID() {
			return $this->pers_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getContrasena() {
			return $this->contrasena;
		}
		public function getRolID() {
			return $this->rol_id;
		}
		public function getFechaAcceso() {
			return $this->fecha_acceso;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setUsuID($usu_id) {
			$this->usu_id = $usu_id;
		}
		public function setPersID($usu_pers_id) {
			$this->pers_id = $usu_pers_id;
		}
		public function setNombre($usu_nombre) {
			$this->nombre = $usu_nombre;
		}
		public function setContrasena($usu_contrasena) {
			$this->contrasena = $usu_contrasena;
		}
		public function setRolID($usu_rol_id) {
			$this->rol_id = $usu_rol_id;
		}
		public function setFechaAcceso($usu_fecha_acceso) {
			$this->fecha_acceso = $usu_fecha_acceso;
		}
		public function setFechaReg($usu_fecha_reg) {
			$this->fecha_reg = $usu_fecha_reg;
		}
		public function setEstado($usu_estado) {
			$this->estado = $usu_estado;
		}
	}
