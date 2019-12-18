<?php

	class rutadet {

		var $ruta_id;
		var $lug_id;
		var $nro_ord;
		var $distancia;

		public function getRutaID() {
			return $this->ruta_id;
		}
		public function getLugID() {
			return $this->lug_id;
		}
		public function getNroOrd() {
			return $this->nro_ord;
		}
		public function getDistancia() {
			return $this->distancia;
		}

		public function setRutaID($rutad_ruta_id) {
			$this->ruta_id = $rutad_ruta_id;
		}
		public function setLugID($rutad_lug_id) {
			$this->lug_id = $rutad_lug_id;
		}
		public function setNroOrd($rutad_nro_ord) {
			$this->nro_ord = $rutad_nro_ord;
		}
		public function setDistancia($rutad_distancia) {
			$this->distancia = $rutad_distancia;
		}
	}
