<?php
	include_once 'conexion.php';

	class sitioDAL {

		function getByID($sitio_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_sitio_getByID('$sitio_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($sitio_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_sitio_listCbo('$sitio_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $sitio_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Sitio_list('$b', '$sitio_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(sitio $sitio) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Sitio_insert(
					@sitio_id,
					'$sitio->nombre',
					'$sitio->tipositio_id',
					'$sitio->latitud_geo',
					'$sitio->longitud_geo',
					'$sitio->celular',
					'$sitio->telefono',
					'$sitio->webpage',
					'$sitio->ubig_id',
					'$sitio->direccion',
					'$sitio->calificacion',
					'$sitio->situacion');");

			$sitio_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $sitio_id;
		}

		public function actualizar(sitio $sitio) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Sitio_update(
					'$sitio->sitio_id',
					'$sitio->nombre',
					'$sitio->tipositio_id',
					'$sitio->latitud_geo',
					'$sitio->longitud_geo',
					'$sitio->celular',
					'$sitio->telefono',
					'$sitio->webpage',
					'$sitio->ubig_id',
					'$sitio->direccion',
					'$sitio->calificacion',
					'$sitio->situacion');");
			return $rs;
		}

		public function borrar($sitio_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Sitio_delete('$sitio_id');");
			return $rs;
		}

		public function activar($sitio_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Sitio_activate('$sitio_id');");
			return $rs;
		}
	}
