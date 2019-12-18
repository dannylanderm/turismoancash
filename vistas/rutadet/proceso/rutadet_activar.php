<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/rutadetDAL.php';

	if (isset($_POST['rutad_ruta_id'], $_POST['rutad_lug_id'], $_POST['rutad_nro_ord'])){
		$rutad_dal = new rutadetDAL();

		$rutad_ruta_id = $_POST['rutad_ruta_id'];
		$rutad_lug_id = $_POST['rutad_lug_id'];
		$rutad_nro_ord = $_POST['rutad_nro_ord'];
		$rutad_rs = $rutad_dal->activar($rutad_ruta_id, $rutad_lug_id, $rutad_nro_ord);

		echo ($rutad_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
