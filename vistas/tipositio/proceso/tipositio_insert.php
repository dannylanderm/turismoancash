<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/tipositio.php';
	include_once '../../../includes/tipositioDAL.php';

	if (isset($_POST['tipositio_nombre'])){

		$tipositio_dal = new tipositioDAL();
		$tipositio = new tipositio();

		$tipositio->nombre = $_POST['tipositio_nombre'];

		$tipositio_rs = $tipositio_dal->registrar($tipositio);
		echo ($tipositio_rs > 0) ? $tipositio_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>