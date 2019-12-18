<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/ruta.php';
	include_once '../../../includes/rutaDAL.php';

	if (isset($_POST['ruta_id'])) {

		$ruta_dal = new rutaDAL();
		$ruta = new ruta();

		$ruta_id = $_POST['ruta_id'];
		$ruta_row = $ruta_dal->getByID($ruta_id);

		$ruta->ruta_id	 = $ruta_id;
		$ruta->descripcion	 = getField('ruta_descripcion', $ruta_row);
		$ruta->estado	 = getField('ruta_estado', $ruta_row);

		$ruta_rs = $ruta_dal->actualizar($ruta);
		echo ($ruta_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
