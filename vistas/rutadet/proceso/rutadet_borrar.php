<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/rutadetDAL.php';

	if (isset($_POST['rutad_ruta_id'], $_POST['rutad_lug_id'], $_POST['rutad_nro_ord'])){
		$rutad_dal = new rutadetDAL();

		$rutad_ruta_id = $_POST['rutad_ruta_id'];
		$rutad_lug_id = $_POST['rutad_lug_id'];
		$rutad_nro_ord = $_POST['rutad_nro_ord'];
		$rutad_rs = $rutad_dal->borrar($rutad_ruta_id, $rutad_lug_id, $rutad_nro_ord);

		echo ($rutad_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
