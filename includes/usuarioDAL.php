<?php
	include_once 'conexion.php';
	
	class usuarioDAL
	{
		function login($nombre, $contrasena) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_login('$nombre', $contrasena);");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		function getByID($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_getByID('$usu_id');");
			$row   = $rs ? mysqli_fetch_assoc($rs) : null;
			return $row;
		}
		
		public function listarCbo($usu_id = 0) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_listCbo('$usu_id');");
			return $mysql->rsToArray($rs);
		}
		
		public function listar($b = '', $usu_estado = 1) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Usuario_list('$b', '$usu_estado');");
			return $mysql->rsToArray($rs);
		}
		
		public function listarAll($b = '') {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_usuario_listAll('$b');");
			return $mysql->rsToArray($rs);
		}
		
		public function registrar(usuario $usu) {
			$mysql = new Conexion(false);
			$mysql->conectar();
			$rs = $mysql->ejecutar("
				CALL pa_Usuario_insert(
					@usu_id,
					'$usu->pers_id',
					'$usu->nombre',
					'$usu->contrasena',
					'$usu->rol_id');");
			
			$usu_id = $rs ? $mysql->getLastID() : 0;
			$mysql->desconectar();
			return $usu_id;
		}
		
		public function actualizar(usuario $usu) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("
				CALL pa_Usuario_update(
					'$usu->usu_id',
					'$usu->pers_id',
					'$usu->nombre',
					'$usu->rol_id',
					'$usu->fecha_acceso');");
			return $rs;
		}
		
		public function updateFechaAcceso($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("UPDATE usuario SET usu_fecha_acceso = now() WHERE usu_id = '$usu_id';");
			return $rs;
		}
		
		public function borrar($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Usuario_delete('$usu_id');");
			return $rs;
		}
		
		public function activar($usu_id) {
			$mysql = new Conexion();
			$rs    = $mysql->ejecutar("CALL pa_Usuario_activate('$usu_id');");
			return $rs;
		}
	}
