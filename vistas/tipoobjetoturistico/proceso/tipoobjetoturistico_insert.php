<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/tipoobjetoturistico.php';
	include_once '../../../includes/tipoobjetoturisticoDAL.php';

	if (isset($_POST['tipoobj_nombre'])){

		$tipoobj_dal = new tipoobjetoturisticoDAL();
		$tipoobj = new tipoobjetoturistico();

		$tipoobj->nombre = $_POST['tipoobj_nombre'];

		$tipoobj_rs = $tipoobj_dal->registrar($tipoobj);
		echo ($tipoobj_rs > 0) ? $tipoobj_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>