<?php
	include_once 'conexion.php';

	class cercaniaDAL {

		function getByID($cerca_lug_id, $cerca_sitio_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cercania_getByID('$cerca_lug_id', '$cerca_sitio_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($cerca_lug_id = 0, $cerca_sitio_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_cercania_listCbo('$cerca_lug_id', '$cerca_sitio_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '') {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Cercania_list('$b');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(cercania $cerca) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Cercania_insert(
					'$cerca->lug_id',
					'$cerca->sitio_id',
					'$cerca->distancia');");
			$mysql->desconectar();
			return $rs;
		}

		public function actualizar(cercania $cerca) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Cercania_update(
					'$cerca->lug_id',
					'$cerca->sitio_id',
					'$cerca->distancia');");
			return $rs;
		}
		
		public function activar($cerca_lug_id, $cerca_sitio_id){
			return 1;
		}
		
		public function borrar($cerca_lug_id, $cerca_sitio_id){
			return 1;
		}
		
	}
