<?php
	include_once 'conexion.php';

	class recomendacionDAL {

		function getByID($rec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_recomendacion_getByID('$rec_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($rec_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_recomendacion_listCbo('$rec_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $rec_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Recomendacion_list('$b', '$rec_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(recomendacion $rec) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Recomendacion_insert(
					@rec_id,
					'$rec->lug_id',
					'$rec->tiporec_id',
					'$rec->descripcion');");

			$rec_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $rec_id;
		}

		public function actualizar(recomendacion $rec) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Recomendacion_update(
					'$rec->rec_id',
					'$rec->lug_id',
					'$rec->tiporec_id',
					'$rec->descripcion');");
			return $rs;
		}

		public function borrar($rec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Recomendacion_delete('$rec_id');");
			return $rs;
		}

		public function activar($rec_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Recomendacion_activate('$rec_id');");
			return $rs;
		}
	}
