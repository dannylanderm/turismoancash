<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/categorialugarDAL.php';

	if (isset($_POST['catlug_id'])){
		$catlug_dal = new categorialugarDAL();

		$catlug_id = $_POST['catlug_id'];
		$catlug_rs = $catlug_dal->borrar($catlug_id);

		echo ($catlug_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
