<?php
	include_once 'conexion.php';

	class galeriaDAL {

		function getByID($gal_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_galeria_getByID('$gal_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($gal_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_galeria_listCbo('$gal_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '', $gal_estado = 1) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Galeria_list('$b', '$gal_estado');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(galeria $gal) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Galeria_insert(
					@gal_id,
					'$gal->lug_id',
					'$gal->foto',
					'$gal->foto_descripcion');");

			$gal_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $gal_id;
		}

		public function actualizar(galeria $gal) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Galeria_update(
					'$gal->gal_id',
					'$gal->lug_id',
					'$gal->foto',
					'$gal->foto_descripcion');");
			return $rs;
		}

		public function borrar($gal_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Galeria_delete('$gal_id');");
			return $rs;
		}

		public function activar($gal_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Galeria_activate('$gal_id');");
			return $rs;
		}
	}
