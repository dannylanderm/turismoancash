<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/tipolugarDAL.php';

	if (isset($_POST['tipolug_id'])){
		$tipolug_dal = new tipolugarDAL();

		$tipolug_id = $_POST['tipolug_id'];
		$tipolug_rs = $tipolug_dal->borrar($tipolug_id);

		echo ($tipolug_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
