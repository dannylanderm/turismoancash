<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/tipositioDAL.php';

	if (isset($_POST['tipositio_id'])){
		$tipositio_dal = new tipositioDAL();

		$tipositio_id = $_POST['tipositio_id'];
		$tipositio_rs = $tipositio_dal->activar($tipositio_id);

		echo ($tipositio_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
