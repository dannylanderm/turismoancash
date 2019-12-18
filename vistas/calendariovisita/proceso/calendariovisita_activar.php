<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/calendariovisitaDAL.php';

	if (isset($_POST['calend_id'])){
		$calend_dal = new calendariovisitaDAL();

		$calend_id = $_POST['calend_id'];
		$calend_rs = $calend_dal->activar($calend_id);

		echo ($calend_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
