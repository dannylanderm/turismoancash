<?php
	include_once 'conexion.php';

	class tipoobjetoturisticoDAL {

		function getByID($tipoobj_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoobjetoturistico_getByID('$tipoobj_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($tipoobj_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_tipoobjetoturistico_listCbo('$tipoobj_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $tipoobj_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoobjetoturistico_list('$b', '$tipoobj_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(tipoobjetoturistico $tipoobj) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Tipoobjetoturistico_insert(
					@tipoobj_id,
					'$tipoobj->nombre');");

			$tipoobj_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $tipoobj_id;
		}

		public function actualizar(tipoobjetoturistico $tipoobj) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Tipoobjetoturistico_update(
					'$tipoobj->tipoobj_id',
					'$tipoobj->nombre');");
			return $rs;
		}

		public function borrar($tipoobj_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoobjetoturistico_delete('$tipoobj_id');");
			return $rs;
		}

		public function activar($tipoobj_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Tipoobjetoturistico_activate('$tipoobj_id');");
			return $rs;
		}
	}
