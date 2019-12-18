<?php
	include_once 'conexion.php';

	class rutaDAL {

		function getByID($ruta_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ruta_getByID('$ruta_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($ruta_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_ruta_listCbo('$ruta_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $ruta_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Ruta_list('$b', '$ruta_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(ruta $ruta) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Ruta_insert(
					@ruta_id,
					'$ruta->descripcion');");

			$ruta_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $ruta_id;
		}

		public function actualizar(ruta $ruta) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Ruta_update(
					'$ruta->ruta_id',
					'$ruta->descripcion');");
			return $rs;
		}

		public function borrar($ruta_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Ruta_delete('$ruta_id');");
			return $rs;
		}

		public function activar($ruta_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Ruta_activate('$ruta_id');");
			return $rs;
		}
	}
