<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/ruta.php';
	include_once '../../../includes/rutaDAL.php';

	if (isset($_POST['ruta_descripcion'])){

		$ruta_dal = new rutaDAL();
		$ruta = new ruta();

		$ruta->descripcion = $_POST['ruta_descripcion'];

		$ruta_rs = $ruta_dal->registrar($ruta);
		echo ($ruta_rs > 0) ? $ruta_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
