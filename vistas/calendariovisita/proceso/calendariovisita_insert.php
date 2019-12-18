<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/calendariovisita.php';
	include_once '../../../includes/calendariovisitaDAL.php';

	if (isset($_POST['calend_lug_id'], $_POST['calend_nro'], $_POST['calend_fecha_ini'], $_POST['calend_fecha_fin'], $_POST['calend_hora_ini'], $_POST['calend_hora_fin'], $_POST['calend_situacion'])){

		$calend_dal = new calendariovisitaDAL();
		$calend = new calendariovisita();

		$calend->lug_id = $_POST['calend_lug_id'];
		$calend->nro = $_POST['calend_nro'];
		$calend->fecha_ini = $_POST['calend_fecha_ini'];
		$calend->fecha_fin = $_POST['calend_fecha_fin'];
		$calend->hora_ini = $_POST['calend_hora_ini'];
		$calend->hora_fin = $_POST['calend_hora_fin'];
		$calend->situacion = $_POST['calend_situacion'];

		$calend_rs = $calend_dal->registrar($calend);
		echo ($calend_rs > 0) ? $calend_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
