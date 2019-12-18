<?php

	class calendariovisita {

		var $calend_id;
		var $lug_id;
		var $nro;
		var $fecha_ini;
		var $fecha_fin;
		var $hora_ini;
		var $hora_fin;
		var $situacion;
		var $estado;

		public function getCalendID() {
			return $this->calend_id;
		}
		public function getLugID() {
			return $this->lug_id;
		}
		public function getNro() {
			return $this->nro;
		}
		public function getFechaIni() {
			return $this->fecha_ini;
		}
		public function getFechaFin() {
			return $this->fecha_fin;
		}
		public function getHoraIni() {
			return $this->hora_ini;
		}
		public function getHoraFin() {
			return $this->hora_fin;
		}
		public function getSituacion() {
			return $this->situacion;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setCalendID($calend_id) {
			$this->calend_id = $calend_id;
		}
		public function setLugID($calend_lug_id) {
			$this->lug_id = $calend_lug_id;
		}
		public function setNro($calend_nro) {
			$this->nro = $calend_nro;
		}
		public function setFechaIni($calend_fecha_ini) {
			$this->fecha_ini = $calend_fecha_ini;
		}
		public function setFechaFin($calend_fecha_fin) {
			$this->fecha_fin = $calend_fecha_fin;
		}
		public function setHoraIni($calend_hora_ini) {
			$this->hora_ini = $calend_hora_ini;
		}
		public function setHoraFin($calend_hora_fin) {
			$this->hora_fin = $calend_hora_fin;
		}
		public function setSituacion($calend_situacion) {
			$this->situacion = $calend_situacion;
		}
		public function setEstado($calend_estado) {
			$this->estado = $calend_estado;
		}
	}
