<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/categorialugar.php';
	include_once '../../../includes/categorialugarDAL.php';

	if (isset($_POST['catlug_nombre'])){

		$catlug_dal = new categorialugarDAL();
		$catlug = new categorialugar();

		$catlug->nombre = $_POST['catlug_nombre'];

		$catlug_rs = $catlug_dal->registrar($catlug);
		echo ($catlug_rs > 0) ? $catlug_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
