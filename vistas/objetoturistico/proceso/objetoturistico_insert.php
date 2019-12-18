<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/objetoturistico.php';
	include_once '../../../includes/objetoturisticoDAL.php';

	if (isset($_POST['obj_nombre'], $_POST['obj_tipoobj_id'], $_POST['obj_foto'], $_POST['obj_comentario'], $_POST['obj_fecha_datacion'], $_POST['obj_lug_id'], $_POST['obj_situacion'])){

		$obj_dal = new objetoturisticoDAL();
		$obj = new objetoturistico();

		$obj->nombre = $_POST['obj_nombre'];
		$obj->tipoobj_id = $_POST['obj_tipoobj_id'];
		$obj->foto = $_POST['obj_foto'];
		$obj->comentario = $_POST['obj_comentario'];
		$obj->fecha_datacion = $_POST['obj_fecha_datacion'];
		$obj->lug_id = $_POST['obj_lug_id'];
		$obj->situacion = $_POST['obj_situacion'];

		$obj_rs = $obj_dal->registrar($obj);
		echo ($obj_rs > 0) ? $obj_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>