<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/tipoobjetoturisticoDAL.php';

	if (isset($_POST['tipoobj_id'])){
		$tipoobj_dal = new tipoobjetoturisticoDAL();

		$tipoobj_id = $_POST['tipoobj_id'];
		$tipoobj_rs = $tipoobj_dal->borrar($tipoobj_id);

		echo ($tipoobj_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
