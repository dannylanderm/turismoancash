<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/rolDAL.php';

	if (isset($_POST['rol_id'])){
		$rol_dal = new rolDAL();

		$rol_id = $_POST['rol_id'];
		$rol_rs = $rol_dal->borrar($rol_id);

		echo ($rol_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
