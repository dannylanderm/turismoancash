<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/tiporecomendacionDAL.php';

	if (isset($_POST['tiporec_id'])){
		$tiporec_dal = new tiporecomendacionDAL();

		$tiporec_id = $_POST['tiporec_id'];
		$tiporec_rs = $tiporec_dal->borrar($tiporec_id);

		echo ($tiporec_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
