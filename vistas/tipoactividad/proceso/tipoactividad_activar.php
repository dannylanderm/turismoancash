<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/tipoactividadDAL.php';

	if (isset($_POST['tipoactiv_id'])){
		$tipoactiv_dal = new tipoactividadDAL();

		$tipoactiv_id = $_POST['tipoactiv_id'];
		$tipoactiv_rs = $tipoactiv_dal->activar($tipoactiv_id);

		echo ($tipoactiv_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
