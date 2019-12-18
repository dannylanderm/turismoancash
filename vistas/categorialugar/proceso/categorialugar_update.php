<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/categorialugar.php';
	include_once '../../../includes/categorialugarDAL.php';

	if (isset($_POST['catlug_id'])) {

		$catlug_dal = new categorialugarDAL();
		$catlug = new categorialugar();

		$catlug_id = $_POST['catlug_id'];
		$catlug_row = $catlug_dal->getByID($catlug_id);

		$catlug->catlug_id	 = $catlug_id;
		$catlug->nombre	 = getField('catlug_nombre', $catlug_row);
		$catlug->estado	 = getField('catlug_estado', $catlug_row);

		$catlug_rs = $catlug_dal->actualizar($catlug);
		echo ($catlug_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>