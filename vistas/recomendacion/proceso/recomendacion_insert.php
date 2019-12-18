<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/recomendacion.php';
	include_once '../../../includes/recomendacionDAL.php';

	if (isset($_POST['rec_lug_id'], $_POST['rec_tiporec_id'], $_POST['rec_descripcion'])){

		$rec_dal = new recomendacionDAL();
		$rec = new recomendacion();

		$rec->lug_id = $_POST['rec_lug_id'];
		$rec->tiporec_id = $_POST['rec_tiporec_id'];
		$rec->descripcion = $_POST['rec_descripcion'];

		$rec_rs = $rec_dal->registrar($rec);
		echo ($rec_rs > 0) ? $rec_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>