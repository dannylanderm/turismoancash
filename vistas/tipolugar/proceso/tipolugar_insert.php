<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/tipolugar.php';
	include_once '../../../includes/tipolugarDAL.php';

	if (isset($_POST['tipolug_nombre'], $_POST['tipolug_catlug_id'])){

		$tipolug_dal = new tipolugarDAL();
		$tipolug = new tipolugar();

		$tipolug->nombre = $_POST['tipolug_nombre'];
		$tipolug->catlug_id = $_POST['tipolug_catlug_id'];

		$tipolug_rs = $tipolug_dal->registrar($tipolug);
		echo ($tipolug_rs > 0) ? $tipolug_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>