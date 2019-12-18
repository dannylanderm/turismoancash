<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/tipoobjetoturistico.php';
	include_once '../../../includes/tipoobjetoturisticoDAL.php';

	if (isset($_POST['tipoobj_id'])) {

		$tipoobj_dal = new tipoobjetoturisticoDAL();
		$tipoobj = new tipoobjetoturistico();

		$tipoobj_id = $_POST['tipoobj_id'];
		$tipoobj_row = $tipoobj_dal->getByID($tipoobj_id);

		$tipoobj->tipoobj_id	 = $tipoobj_id;
		$tipoobj->nombre	 = getField('tipoobj_nombre', $tipoobj_row);
		$tipoobj->estado	 = getField('tipoobj_estado', $tipoobj_row);

		$tipoobj_rs = $tipoobj_dal->actualizar($tipoobj);
		echo ($tipoobj_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>