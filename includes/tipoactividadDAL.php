<?php
	include_once 'conexion.php';

	class tipoactividadDAL {

		function getByID($tipoactiv_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoactividad_getByID('$tipoactiv_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($tipoactiv_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoactividad_listCbo('$tipoactiv_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tipoactiv_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoactividad_list('$b', '$tipoactiv_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tipoactividad $tipoactiv) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Tipoactividad_insert(
					@tipoactiv_id,
					'$tipoactiv->nombre');");

			$tipoactiv_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tipoactiv_id;
		}

		public function actualizar(tipoactividad $tipoactiv) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Tipoactividad_update(
					'$tipoactiv->tipoactiv_id',
					'$tipoactiv->nombre');");
			return $rs;
		}

		public function borrar($tipoactiv_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoactividad_delete('$tipoactiv_id');");
			return $rs;
		}

		public function activar($tipoactiv_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoactividad_activate('$tipoactiv_id');");
			return $rs;
		}
	}
