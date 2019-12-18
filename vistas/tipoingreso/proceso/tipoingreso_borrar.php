<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/tipoingresoDAL.php';

	if (isset($_POST['tipoing_id'])){
		$tipoing_dal = new tipoingresoDAL();

		$tipoing_id = $_POST['tipoing_id'];
		$tipoing_rs = $tipoing_dal->borrar($tipoing_id);

		echo ($tipoing_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
