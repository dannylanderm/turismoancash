<?php
	include_once 'conexion.php';

	class personaDAL {

		function getByID($pers_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_persona_getByID('$pers_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($pers_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_persona_listCbo('$pers_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $pers_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Persona_list('$b', '$pers_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(persona $pers) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Persona_insert(
					@pers_id,
					'$pers->ap_paterno',
					'$pers->ap_materno',
					'$pers->nombres',
					'$pers->correo');");

			$pers_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $pers_id;
		}

		public function actualizar(persona $pers) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Persona_update(
					'$pers->pers_id',
					'$pers->ap_paterno',
					'$pers->ap_materno',
					'$pers->nombres',
					'$pers->correo');");
			return $rs;
		}

		public function borrar($pers_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Persona_delete('$pers_id');");
			return $rs;
		}

		public function activar($pers_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Persona_activate('$pers_id');");
			return $rs;
		}
	}
