<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/tipoactividad.php';
	include_once '../../../includes/tipoactividadDAL.php';

	if (isset($_POST['tipoactiv_nombre'])){

		$tipoactiv_dal = new tipoactividadDAL();
		$tipoactiv = new tipoactividad();

		$tipoactiv->nombre = $_POST['tipoactiv_nombre'];

		$tipoactiv_rs = $tipoactiv_dal->registrar($tipoactiv);
		echo ($tipoactiv_rs > 0) ? $tipoactiv_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>