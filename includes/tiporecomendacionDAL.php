<?php
	include_once 'conexion.php';

	class tiporecomendacionDAL {

		function getByID($tiporec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tiporecomendacion_getByID('$tiporec_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($tiporec_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tiporecomendacion_listCbo('$tiporec_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tiporec_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tiporecomendacion_list('$b', '$tiporec_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tiporecomendacion $tiporec) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Tiporecomendacion_insert(
					@tiporec_id,
					'$tiporec->nombre');");

			$tiporec_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tiporec_id;
		}

		public function actualizar(tiporecomendacion $tiporec) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Tiporecomendacion_update(
					'$tiporec->tiporec_id',
					'$tiporec->nombre');");
			return $rs;
		}

		public function borrar($tiporec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tiporecomendacion_delete('$tiporec_id');");
			return $rs;
		}

		public function activar($tiporec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tiporecomendacion_activate('$tiporec_id');");
			return $rs;
		}
	}
