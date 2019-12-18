<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/lugarturisticoDAL.php';

	if (isset($_POST['lug_id'])){
		$lug_dal = new lugarturisticoDAL();

		$lug_id = $_POST['lug_id'];
		$lug_rs = $lug_dal->activar($lug_id);

		echo ($lug_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
