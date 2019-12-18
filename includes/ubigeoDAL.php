<?php
	include_once 'conexion.php';

	class ubigeoDAL {

		function getByID($ubig_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_getByID('$ubig_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($ubig_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ubigeo_listCbo('$ubig_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $ubig_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Ubigeo_list('$b', '$ubig_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(ubigeo $ubig) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Ubigeo_insert(
					@ubig_id,
					'$ubig->codigo',
					'$ubig->dpto_cod',
					'$ubig->prov_cod',
					'$ubig->dist_cod',
					'$ubig->nombre');");

			$ubig_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $ubig_id;
		}

		public function actualizar(ubigeo $ubig) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Ubigeo_update(
					'$ubig->ubig_id',
					'$ubig->codigo',
					'$ubig->dpto_cod',
					'$ubig->prov_cod',
					'$ubig->dist_cod',
					'$ubig->nombre');");
			return $rs;
		}

		public function borrar($ubig_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Ubigeo_delete('$ubig_id');");
			return $rs;
		}

		public function activar($ubig_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Ubigeo_activate('$ubig_id');");
			return $rs;
		}
	}
