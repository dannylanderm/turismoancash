<?php
	include_once 'conexion.php';

	class tipolugarDAL {

		function getByID($tipolug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipolugar_getByID('$tipolug_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($tipolug_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipolugar_listCbo('$tipolug_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tipolug_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipolugar_list('$b', '$tipolug_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tipolugar $tipolug) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Tipolugar_insert(
					@tipolug_id,
					'$tipolug->nombre',
					'$tipolug->catlug_id');");

			$tipolug_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tipolug_id;
		}

		public function actualizar(tipolugar $tipolug) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Tipolugar_update(
					'$tipolug->tipolug_id',
					'$tipolug->nombre',
					'$tipolug->catlug_id');");
			return $rs;
		}

		public function borrar($tipolug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipolugar_delete('$tipolug_id');");
			return $rs;
		}

		public function activar($tipolug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipolugar_activate('$tipolug_id');");
			return $rs;
		}
	}
