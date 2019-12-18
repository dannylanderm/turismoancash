<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/usuarioDAL.php';

	if (isset($_POST['usu_id'])){
		$usu_dal = new usuarioDAL();

		$usu_id = $_POST['usu_id'];
		$usu_rs = $usu_dal->activar($usu_id);

		echo ($usu_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
