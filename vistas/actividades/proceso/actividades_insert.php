<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/actividades.php';
	include_once '../../../includes/actividadesDAL.php';

	if (isset($_POST['activ_lug_id'], $_POST['activ_tipoactiv_id'], $_POST['activ_situacion'])){

		$activ_dal = new actividadesDAL();
		$activ = new actividades();

		$activ->lug_id = $_POST['activ_lug_id'];
		$activ->tipoactiv_id = $_POST['activ_tipoactiv_id'];
		$activ->situacion = $_POST['activ_situacion'];

		$activ_rs = $activ_dal->registrar($activ);
		echo ($activ_rs > 0) ? $activ_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>