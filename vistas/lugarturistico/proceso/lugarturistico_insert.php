<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];

	include_once '../../../entidades/lugarturistico.php';
	include_once '../../../includes/lugarturisticoDAL.php';

	if (isset($_POST['lug_nombre'], $_POST['lug_tipolug_id'], $_POST['lug_latitud_geo'], $_POST['lug_longitud_geo'], $_POST['lug_altitud'], $_POST['lug_tamanio_area'], $_POST['lug_foto'], $_POST['lug_descripcion'], $_POST['lug_ubig_id'], $_POST['lug_direccion_ref'], $_POST['lug_tipoing_id'], $_POST['lug_calificacion'], $_POST['lug_situacion'], $_POST['lug_resenia'])){

		$lug_dal = new lugarturisticoDAL();
		$lug = new lugarturistico();

		$lug->nombre = $_POST['lug_nombre'];
		$lug->tipolug_id = $_POST['lug_tipolug_id'];
		$lug->latitud_geo = $_POST['lug_latitud_geo'];
		$lug->longitud_geo = $_POST['lug_longitud_geo'];
		$lug->altitud = $_POST['lug_altitud'];
		$lug->tamanio_area = $_POST['lug_tamanio_area'];
		$lug->foto = $_POST['lug_foto'];
		$lug->descripcion = $_POST['lug_descripcion'];
		$lug->ubig_id = $_POST['lug_ubig_id'];
		$lug->direccion_ref = $_POST['lug_direccion_ref'];
		$lug->tipoing_id = $_POST['lug_tipoing_id'];
		$lug->calificacion = $_POST['lug_calificacion'];
		$lug->situacion = $_POST['lug_situacion'];
		$lug->resenia = $_POST['lug_resenia'];

		$lug_rs = $lug_dal->registrar($lug);
		echo ($lug_rs > 0) ? $lug_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
