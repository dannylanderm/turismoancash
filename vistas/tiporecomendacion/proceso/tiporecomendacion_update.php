<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/tiporecomendacion.php';
	include_once '../../../includes/tiporecomendacionDAL.php';

	if (isset($_POST['tiporec_id'])) {

		$tiporec_dal = new tiporecomendacionDAL();
		$tiporec = new tiporecomendacion();

		$tiporec_id = $_POST['tiporec_id'];
		$tiporec_row = $tiporec_dal->getByID($tiporec_id);

		$tiporec->tiporec_id	 = $tiporec_id;
		$tiporec->nombre	 = getField('tiporec_nombre', $tiporec_row);
		$tiporec->estado	 = getField('tiporec_estado', $tiporec_row);

		$tiporec_rs = $tiporec_dal->actualizar($tiporec);
		echo ($tiporec_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>