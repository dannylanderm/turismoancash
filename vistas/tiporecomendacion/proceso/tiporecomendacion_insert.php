<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/tiporecomendacion.php';
	include_once '../../../includes/tiporecomendacionDAL.php';

	if (isset($_POST['tiporec_nombre'])){

		$tiporec_dal = new tiporecomendacionDAL();
		$tiporec = new tiporecomendacion();

		$tiporec->nombre = $_POST['tiporec_nombre'];

		$tiporec_rs = $tiporec_dal->registrar($tiporec);
		echo ($tiporec_rs > 0) ? $tiporec_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
