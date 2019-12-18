<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../includes/cercaniaDAL.php';

	if (isset($_POST['cerca_lug_id'], $_POST['cerca_sitio_id'])){
		$cerca_dal = new cercaniaDAL();

		$cerca_lug_id = $_POST['cerca_lug_id'];
		$cerca_sitio_id = $_POST['cerca_sitio_id'];
		$cerca_rs = $cerca_dal->activar($cerca_lug_id, $cerca_sitio_id);

		echo ($cerca_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
