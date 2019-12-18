<?php
	include_once 'conexion.php';

	class lugarturisticoDAL {

		function getByID($lug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_lugarturistico_getByID('$lug_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($lug_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_lugarturistico_listCbo('$lug_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $lug_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Lugarturistico_list('$b', '$lug_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function m_listar($b = '', $lug_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Lugarturistico_list_m('$b', '$lug_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(lugarturistico $lug) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Lugarturistico_insert(
					@lug_id,
					'$lug->nombre',
					'$lug->tipolug_id',
					'$lug->latitud_geo',
					'$lug->longitud_geo',
					'$lug->altitud',
					'$lug->tamanio_area',
					'$lug->foto',
					'$lug->descripcion',
					'$lug->ubig_id',
					'$lug->direccion_ref',
					'$lug->tipoing_id',
					'$lug->calificacion',
					'$lug->situacion',
					'$lug->resenia');");

			$lug_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $lug_id;
		}

		public function actualizar(lugarturistico $lug) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Lugarturistico_update(
					'$lug->lug_id',
					'$lug->nombre',
					'$lug->tipolug_id',
					'$lug->latitud_geo',
					'$lug->longitud_geo',
					'$lug->altitud',
					'$lug->tamanio_area',
					'$lug->foto',
					'$lug->descripcion',
					'$lug->ubig_id',
					'$lug->direccion_ref',
					'$lug->tipoing_id',
					'$lug->calificacion',
					'$lug->situacion',
					'$lug->resenia');");
			return $rs;
		}

		public function borrar($lug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Lugarturistico_delete('$lug_id');");
			return $rs;
		}

		public function activar($lug_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Lugarturistico_activate('$lug_id');");
			return $rs;
		}
	}
