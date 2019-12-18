<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/usuario.php';
	include_once '../../../includes/usuarioDAL.php';

	if (isset($_POST['usu_pers_id'], $_POST['usu_nombre'], $_POST['usu_contrasena'], $_POST['usu_rol_id'], $_POST['usu_fecha_acceso'])){

		$usu_dal = new usuarioDAL();
		$usu = new usuario();

		$usu->pers_id = $_POST['usu_pers_id'];
		$usu->nombre = $_POST['usu_nombre'];
		$usu->contrasena = $_POST['usu_contrasena'];
		$usu->rol_id = $_POST['usu_rol_id'];
		$usu->fecha_acceso = $_POST['usu_fecha_acceso'];

		$usu_rs = $usu_dal->registrar($usu);
		echo ($usu_rs > 0) ? $usu_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>