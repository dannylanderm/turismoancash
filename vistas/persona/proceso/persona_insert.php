<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/persona.php';
	include_once '../../../includes/personaDAL.php';

	if (isset($_POST['pers_ap_paterno'], $_POST['pers_ap_materno'], $_POST['pers_nombres'], $_POST['pers_correo'])){

		$pers_dal = new personaDAL();
		$pers = new persona();

		$pers->ap_paterno = $_POST['pers_ap_paterno'];
		$pers->ap_materno = $_POST['pers_ap_materno'];
		$pers->nombres = $_POST['pers_nombres'];
		$pers->correo = $_POST['pers_correo'];

		$pers_rs = $pers_dal->registrar($pers);
		echo ($pers_rs > 0) ? $pers_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>