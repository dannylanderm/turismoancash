<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/galeria.php';
	include_once '../../../includes/galeriaDAL.php';

	if (isset($_POST['gal_id'])) {

		$gal_dal = new galeriaDAL();
		$gal = new galeria();

		$gal_id = $_POST['gal_id'];
		$gal_row = $gal_dal->getByID($gal_id);

		$gal->gal_id	 = $gal_id;
		$gal->lug_id	 = getField('gal_lug_id', $gal_row);
		$gal->foto	 = getField('gal_foto', $gal_row);
		$gal->foto_descripcion	 = getField('gal_foto_descripcion', $gal_row);
		$gal->estado	 = getField('gal_estado', $gal_row);

		$gal_rs = $gal_dal->actualizar($gal);
		echo ($gal_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>