<?php
	include_once 'conexion.php';
	
	class objetoturisticoDAL
	{
		
		function getByID($obj_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_objetoturistico_getByID('$obj_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarCbo($obj_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_objetoturistico_listCbo('$obj_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '', $obj_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Objetoturistico_list('$b', '$obj_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function listarByLugar($lugar, $b = '', $obj_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Objetoturistico_listByLugar('$lugar', '$b', '$obj_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(objetoturistico $obj) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Objetoturistico_insert(
					@obj_id,
					'$obj->nombre',
					'$obj->tipoobj_id',
					'$obj->foto',
					'$obj->comentario',
					'$obj->fecha_datacion',
					'$obj->lug_id',
					'$obj->situacion');");
			
			$obj_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $obj_id;
		}
		
		public function actualizar(objetoturistico $obj) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				CALL pa_Objetoturistico_update(
					'$obj->obj_id',
					'$obj->nombre',
					'$obj->tipoobj_id',
					'$obj->foto',
					'$obj->comentario',
					'$obj->fecha_datacion',
					'$obj->lug_id',
					'$obj->situacion');");
			return $rs;
		}
		
		public function borrar($obj_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Objetoturistico_delete('$obj_id');");
			return $rs;
		}
		
		public function activar($obj_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Objetoturistico_activate('$obj_id');");
			return $rs;
		}
	}
