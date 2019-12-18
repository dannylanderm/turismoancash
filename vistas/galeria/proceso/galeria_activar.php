<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/galeriaDAL.php';

	if (isset($_POST['gal_id'])){
		$gal_dal = new galeriaDAL();

		$gal_id = $_POST['gal_id'];
		$gal_rs = $gal_dal->activar($gal_id);

		echo ($gal_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
