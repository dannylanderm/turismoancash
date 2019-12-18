<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/actividades.php';
	include_once '../../../includes/actividadesDAL.php';

	if (isset($_POST['activ_lug_id'], $_POST['activ_tipoactiv_id'])) {

		$activ_dal = new actividadesDAL();
		$activ = new actividades();

		$activ_lug_id = $_POST['activ_lug_id'];
		$activ_tipoactiv_id = $_POST['activ_tipoactiv_id'];
		$activ_row = $activ_dal->getByID($activ_lug_id, $activ_tipoactiv_id);

		$activ->lug_id	 = $activ_lug_id;
		$activ->tipoactiv_id	 = $activ_tipoactiv_id;
		$activ->situacion	 = getField('activ_situacion', $activ_row);

		$activ_rs = $activ_dal->actualizar($activ);
		echo ($activ_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
