<?php

	class cercania {

		var $lug_id;
		var $sitio_id;
		var $distancia;

		public function getLugID() {
			return $this->lug_id;
		}
		public function getSitioID() {
			return $this->sitio_id;
		}
		public function getDistancia() {
			return $this->distancia;
		}

		public function setLugID($cerca_lug_id) {
			$this->lug_id = $cerca_lug_id;
		}
		public function setSitioID($cerca_sitio_id) {
			$this->sitio_id = $cerca_sitio_id;
		}
		public function setDistancia($cerca_distancia) {
			$this->distancia = $cerca_distancia;
		}
	}
