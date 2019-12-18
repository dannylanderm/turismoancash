<?php
	include_once 'conexion.php';

	class tipoingresoDAL {

		function getByID($tipoing_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoingreso_getByID('$tipoing_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($tipoing_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoingreso_listCbo('$tipoing_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tipoing_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoingreso_list('$b', '$tipoing_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tipoingreso $tipoing) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Tipoingreso_insert(
					@tipoing_id,
					'$tipoing->nombre');");

			$tipoing_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tipoing_id;
		}

		public function actualizar(tipoingreso $tipoing) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Tipoingreso_update(
					'$tipoing->tipoing_id',
					'$tipoing->nombre');");
			return $rs;
		}

		public function borrar($tipoing_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoingreso_delete('$tipoing_id');");
			return $rs;
		}

		public function activar($tipoing_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoingreso_activate('$tipoing_id');");
			return $rs;
		}
	}
