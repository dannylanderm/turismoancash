<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/rutaDAL.php';

	if (isset($_POST['ruta_id'])){
		$ruta_dal = new rutaDAL();

		$ruta_id = $_POST['ruta_id'];
		$ruta_rs = $ruta_dal->activar($ruta_id);

		echo ($ruta_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
