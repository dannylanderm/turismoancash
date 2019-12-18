<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/recomendacion.php';
	include_once '../../../includes/recomendacionDAL.php';

	if (isset($_POST['rec_id'])) {

		$rec_dal = new recomendacionDAL();
		$rec = new recomendacion();

		$rec_id = $_POST['rec_id'];
		$rec_row = $rec_dal->getByID($rec_id);

		$rec->rec_id	 = $rec_id;
		$rec->lug_id	 = getField('rec_lug_id', $rec_row);
		$rec->tiporec_id	 = getField('rec_tiporec_id', $rec_row);
		$rec->descripcion	 = getField('rec_descripcion', $rec_row);
		$rec->estado	 = getField('rec_estado', $rec_row);

		$rec_rs = $rec_dal->actualizar($rec);
		echo ($rec_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
