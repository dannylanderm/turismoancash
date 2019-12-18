<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/tipoingreso.php';
	include_once '../../../includes/tipoingresoDAL.php';

	if (isset($_POST['tipoing_nombre'])){

		$tipoing_dal = new tipoingresoDAL();
		$tipoing = new tipoingreso();

		$tipoing->nombre = $_POST['tipoing_nombre'];

		$tipoing_rs = $tipoing_dal->registrar($tipoing);
		echo ($tipoing_rs > 0) ? $tipoing_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>