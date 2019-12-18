<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/persona.php';
	include_once '../../../includes/personaDAL.php';

	if (isset($_POST['pers_id'])) {

		$pers_dal = new personaDAL();
		$pers = new persona();

		$pers_id = $_POST['pers_id'];
		$pers_row = $pers_dal->getByID($pers_id);

		$pers->pers_id	 = $pers_id;
		$pers->ap_paterno	 = getField('pers_ap_paterno', $pers_row);
		$pers->ap_materno	 = getField('pers_ap_materno', $pers_row);
		$pers->nombres	 = getField('pers_nombres', $pers_row);
		$pers->correo	 = getField('pers_correo', $pers_row);
		$pers->estado	 = getField('pers_estado', $pers_row);

		$pers_rs = $pers_dal->actualizar($pers);
		echo ($pers_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
