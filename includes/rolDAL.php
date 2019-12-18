<?php
	include_once 'conexion.php';

	class rolDAL {

		function getByID($rol_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_rol_getByID('$rol_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($rol_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_rol_listCbo('$rol_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $rol_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Rol_list('$b', '$rol_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(rol $rol) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Rol_insert(
					@rol_id,
					'$rol->nombre');");

			$rol_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $rol_id;
		}

		public function actualizar(rol $rol) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Rol_update(
					'$rol->rol_id',
					'$rol->nombre');");
			return $rs;
		}

		public function borrar($rol_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Rol_delete('$rol_id');");
			return $rs;
		}

		public function activar($rol_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Rol_activate('$rol_id');");
			return $rs;
		}
	}
