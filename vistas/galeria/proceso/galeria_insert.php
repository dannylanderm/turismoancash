<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/galeria.php';
	include_once '../../../includes/galeriaDAL.php';

	if (isset($_POST['gal_lug_id'], $_POST['gal_foto'], $_POST['gal_foto_descripcion'])){

		$gal_dal = new galeriaDAL();
		$gal = new galeria();

		$gal->lug_id = $_POST['gal_lug_id'];
		$gal->foto = $_POST['gal_foto'];
		$gal->foto_descripcion = $_POST['gal_foto_descripcion'];

		$gal_rs = $gal_dal->registrar($gal);
		echo ($gal_rs > 0) ? $gal_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>