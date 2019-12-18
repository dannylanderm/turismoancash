<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/rutadet.php';
	include_once '../../../includes/rutadetDAL.php';

	if (isset($_POST['rutad_ruta_id'], $_POST['rutad_lug_id'], $_POST['rutad_nro_ord'], $_POST['rutad_distancia'])){

		$rutad_dal = new rutadetDAL();
		$rutad = new rutadet();

		$rutad->ruta_id = $_POST['rutad_ruta_id'];
		$rutad->lug_id = $_POST['rutad_lug_id'];
		$rutad->nro_ord = $_POST['rutad_nro_ord'];
		$rutad->distancia = $_POST['rutad_distancia'];

		$rutad_rs = $rutad_dal->registrar($rutad);
		echo ($rutad_rs > 0) ? $rutad_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
