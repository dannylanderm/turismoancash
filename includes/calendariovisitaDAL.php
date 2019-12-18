<?php
	include_once 'conexion.php';

	class calendariovisitaDAL {

		function getByID($calend_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_calendariovisita_getByID('$calend_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($calend_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_calendariovisita_listCbo('$calend_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $calend_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Calendariovisita_list('$b', '$calend_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(calendariovisita $calend) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Calendariovisita_insert(
					@calend_id,
					'$calend->lug_id',
					'$calend->nro',
					'$calend->fecha_ini',
					'$calend->fecha_fin',
					'$calend->hora_ini',
					'$calend->hora_fin',
					'$calend->situacion');");

			$calend_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $calend_id;
		}

		public function actualizar(calendariovisita $calend) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Calendariovisita_update(
					'$calend->calend_id',
					'$calend->lug_id',
					'$calend->nro',
					'$calend->fecha_ini',
					'$calend->fecha_fin',
					'$calend->hora_ini',
					'$calend->hora_fin',
					'$calend->situacion');");
			return $rs;
		}

		public function borrar($calend_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Calendariovisita_delete('$calend_id');");
			return $rs;
		}

		public function activar($calend_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Calendariovisita_activate('$calend_id');");
			return $rs;
		}
	}
