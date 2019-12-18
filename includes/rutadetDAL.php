<?php
	include_once 'conexion.php';
	
	class rutadetDAL
	{
		
		function getByID($rutad_ruta_id, $rutad_lug_id, $rutad_nro_ord) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_rutadet_getByID('$rutad_ruta_id', '$rutad_lug_id', '$rutad_nro_ord');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarCbo($rutad_ruta_id = 0, $rutad_lug_id = 0, $rutad_nro_ord = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_rutadet_listCbo('$rutad_ruta_id', '$rutad_lug_id', '$rutad_nro_ord');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '') {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Rutadet_list('$b');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(rutadet $rutad) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Rutadet_insert(
					'$rutad->ruta_id',
					'$rutad->lug_id',
					'$rutad->nro_ord',
					'$rutad->distancia');");
			$mysql->desconectar();
			return $rs;
		}
		
		public function actualizar(rutadet $rutad) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				CALL pa_Rutadet_update(
					'$rutad->ruta_id',
					'$rutad->lug_id',
					'$rutad->nro_ord',
					'$rutad->distancia');");
			return $rs;
		}
		
		public function activar($rutad_ruta_id, $rutad_lug_id, $rutad_nro_ord) {
			return 1;
		}
		
		public function borrar($rutad_ruta_id, $rutad_lug_id, $rutad_nro_ord) {
			return 1;
		}
	}
