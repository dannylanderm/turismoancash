<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/tipolugar.php';
	include_once '../../../includes/tipolugarDAL.php';

	if (isset($_POST['tipolug_id'])) {

		$tipolug_dal = new tipolugarDAL();
		$tipolug = new tipolugar();

		$tipolug_id = $_POST['tipolug_id'];
		$tipolug_row = $tipolug_dal->getByID($tipolug_id);

		$tipolug->tipolug_id	 = $tipolug_id;
		$tipolug->nombre	 = getField('tipolug_nombre', $tipolug_row);
		$tipolug->catlug_id	 = getField('tipolug_catlug_id', $tipolug_row);
		$tipolug->estado	 = getField('tipolug_estado', $tipolug_row);

		$tipolug_rs = $tipolug_dal->actualizar($tipolug);
		echo ($tipolug_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>