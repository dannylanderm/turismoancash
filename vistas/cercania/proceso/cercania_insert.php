<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/cercania.php';
	include_once '../../../includes/cercaniaDAL.php';

	if (isset($_POST['cerca_lug_id'], $_POST['cerca_sitio_id'], $_POST['cerca_distancia'])){

		$cerca_dal = new cercaniaDAL();
		$cerca = new cercania();

		$cerca->lug_id = $_POST['cerca_lug_id'];
		$cerca->sitio_id = $_POST['cerca_sitio_id'];
		$cerca->distancia = $_POST['cerca_distancia'];

		$cerca_rs = $cerca_dal->registrar($cerca);
		echo ($cerca_rs > 0) ? $cerca_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
