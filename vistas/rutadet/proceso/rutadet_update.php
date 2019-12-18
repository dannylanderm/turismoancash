<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/rutadet.php';
	include_once '../../../includes/rutadetDAL.php';

	if (isset($_POST['rutad_ruta_id'], $_POST['rutad_lug_id'], $_POST['rutad_nro_ord'])) {

		$rutad_dal = new rutadetDAL();
		$rutad = new rutadet();

		$rutad_ruta_id = $_POST['rutad_ruta_id'];
		$rutad_lug_id = $_POST['rutad_lug_id'];
		$rutad_nro_ord = $_POST['rutad_nro_ord'];
		$rutad_row = $rutad_dal->getByID($rutad_ruta_id, $rutad_lug_id, $rutad_nro_ord);

		$rutad->ruta_id	 = $rutad_ruta_id;
		$rutad->lug_id	 = $rutad_lug_id;
		$rutad->nro_ord	 = $rutad_nro_ord;
		$rutad->distancia	 = getField('rutad_distancia', $rutad_row);

		$rutad_rs = $rutad_dal->actualizar($rutad);
		echo ($rutad_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>