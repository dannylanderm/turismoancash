<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/tipoingresoDAL.php';

	if (isset($_POST['tipoing_id'])){
		$tipoing_dal = new tipoingresoDAL();

		$tipoing_id = $_POST['tipoing_id'];
		$tipoing_rs = $tipoing_dal->activar($tipoing_id);

		echo ($tipoing_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
