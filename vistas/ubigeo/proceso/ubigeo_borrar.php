<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/ubigeoDAL.php';

	if (isset($_POST['ubig_id'])){
		$ubig_dal = new ubigeoDAL();

		$ubig_id = $_POST['ubig_id'];
		$ubig_rs = $ubig_dal->borrar($ubig_id);

		echo ($ubig_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
