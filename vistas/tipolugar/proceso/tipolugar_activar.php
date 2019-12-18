<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/tipolugarDAL.php';

	if (isset($_POST['tipolug_id'])){
		$tipolug_dal = new tipolugarDAL();

		$tipolug_id = $_POST['tipolug_id'];
		$tipolug_rs = $tipolug_dal->activar($tipolug_id);

		echo ($tipolug_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
