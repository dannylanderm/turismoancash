<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/actividadesDAL.php';

	if (isset($_POST['activ_lug_id'], $_POST['activ_tipoactiv_id'])){
		$activ_dal = new actividadesDAL();

		$activ_lug_id = $_POST['activ_lug_id'];
		$activ_tipoactiv_id = $_POST['activ_tipoactiv_id'];
		$activ_rs = $activ_dal->activar($activ_lug_id, $activ_tipoactiv_id);

		echo ($activ_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
