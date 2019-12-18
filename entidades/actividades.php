<?php

	class actividades {

		var $lug_id;
		var $tipoactiv_id;
		var $situacion;

		public function getLugID() {
			return $this->lug_id;
		}
		public function getTipoactivID() {
			return $this->tipoactiv_id;
		}
		public function getSituacion() {
			return $this->situacion;
		}

		public function setLugID($activ_lug_id) {
			$this->lug_id = $activ_lug_id;
		}
		public function setTipoactivID($activ_tipoactiv_id) {
			$this->tipoactiv_id = $activ_tipoactiv_id;
		}
		public function setSituacion($activ_situacion) {
			$this->situacion = $activ_situacion;
		}
	}
