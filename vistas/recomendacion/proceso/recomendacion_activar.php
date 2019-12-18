<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/recomendacionDAL.php';

	if (isset($_POST['rec_id'])){
		$rec_dal = new recomendacionDAL();

		$rec_id = $_POST['rec_id'];
		$rec_rs = $rec_dal->activar($rec_id);

		echo ($rec_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
