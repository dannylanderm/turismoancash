<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/objetoturisticoDAL.php';

	if (isset($_POST['obj_id'])){
		$obj_dal = new objetoturisticoDAL();

		$obj_id = $_POST['obj_id'];
		$obj_rs = $obj_dal->activar($obj_id);

		echo ($obj_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
