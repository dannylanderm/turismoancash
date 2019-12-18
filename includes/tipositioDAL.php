<?php
	include_once 'conexion.php';

	class tipositioDAL {

		function getByID($tipositio_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipositio_getByID('$tipositio_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($tipositio_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipositio_listCbo('$tipositio_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tipositio_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipositio_list('$b', '$tipositio_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tipositio $tipositio) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Tipositio_insert(
					@tipositio_id,
					'$tipositio->nombre');");

			$tipositio_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tipositio_id;
		}

		public function actualizar(tipositio $tipositio) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Tipositio_update(
					'$tipositio->tipositio_id',
					'$tipositio->nombre');");
			return $rs;
		}

		public function borrar($tipositio_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipositio_delete('$tipositio_id');");
			return $rs;
		}

		public function activar($tipositio_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipositio_activate('$tipositio_id');");
			return $rs;
		}
	}
