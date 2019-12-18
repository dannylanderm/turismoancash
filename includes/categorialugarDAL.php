<?php
	include_once 'conexion.php';

	class categorialugarDAL {

		function getByID($catlug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categorialugar_getByID('$catlug_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($catlug_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_categorialugar_listCbo('$catlug_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $catlug_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Categorialugar_list('$b', '$catlug_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(categorialugar $catlug) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Categorialugar_insert(
					@catlug_id,
					'$catlug->nombre',
					'$catlug->descripcion');");

			$catlug_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $catlug_id;
		}

		public function actualizar(categorialugar $catlug) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Categorialugar_update(
					'$catlug->catlug_id',
					'$catlug->nombre',
					'$catlug->descripcion');");
			return $rs;
		}

		public function borrar($catlug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Categorialugar_delete('$catlug_id');");
			return $rs;
		}

		public function activar($catlug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Categorialugar_activate('$catlug_id');");
			return $rs;
		}
	}
