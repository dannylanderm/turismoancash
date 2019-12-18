<?php
	include_once 'conexion.php';

	class actividadesDAL {

		function getByID($activ_lug_id, $activ_tipoactiv_id) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_actividades_getByID('$activ_lug_id', '$activ_tipoactiv_id');");
			$row = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}

		public function listarCbo($activ_lug_id = 0, $activ_tipoactiv_id = 0) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_actividades_listCbo('$activ_lug_id', '$activ_tipoactiv_id');");
			return $mysql->rsToArray($rs);
		}

		public function listar($b = '') {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("CALL pa_Actividades_list('$b');");
			return $mysql->rsToArray($rs);
		}

		public function registrar(actividades $activ) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Actividades_insert(
					'$activ->lug_id',
					'$activ->tipoactiv_id',
					'$activ->situacion');");
			$mysql->desconectar();
			return $rs;
		}

		public function actualizar(actividades $activ) {
			$mysql = new Conexion();
			$rs = $mysql->ejecutar("
				CALL pa_Actividades_update(
					'$activ->lug_id',
					'$activ->tipoactiv_id',
					'$activ->situacion');");
			return $rs;
		}

		public function activar($activ_lug_id, $activ_tipoactiv_id){
			return 1;
		}
		
		public function borrar($activ_lug_id, $activ_tipoactiv_id){
			return 1;
		}
	}
