<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/sitioDAL.php';

	if (isset($_POST['sitio_id'])){
		$sitio_dal = new sitioDAL();

		$sitio_id = $_POST['sitio_id'];
		$sitio_rs = $sitio_dal->borrar($sitio_id);

		echo ($sitio_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
