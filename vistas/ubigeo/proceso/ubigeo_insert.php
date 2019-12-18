<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/ubigeo.php';
	include_once '../../../includes/ubigeoDAL.php';

	if (isset($_POST['ubig_codigo'], $_POST['ubig_dpto_cod'], $_POST['ubig_prov_cod'], $_POST['ubig_dist_cod'], $_POST['ubig_nombre'])){

		$ubig_dal = new ubigeoDAL();
		$ubig = new ubigeo();

		$ubig->codigo = $_POST['ubig_codigo'];
		$ubig->dpto_cod = $_POST['ubig_dpto_cod'];
		$ubig->prov_cod = $_POST['ubig_prov_cod'];
		$ubig->dist_cod = $_POST['ubig_dist_cod'];
		$ubig->nombre = $_POST['ubig_nombre'];

		$ubig_rs = $ubig_dal->registrar($ubig);
		echo ($ubig_rs > 0) ? $ubig_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
