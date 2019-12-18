<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/tipoactividad.php';
	include_once '../../../includes/tipoactividadDAL.php';

	if (isset($_POST['tipoactiv_id'])) {

		$tipoactiv_dal = new tipoactividadDAL();
		$tipoactiv = new tipoactividad();

		$tipoactiv_id = $_POST['tipoactiv_id'];
		$tipoactiv_row = $tipoactiv_dal->getByID($tipoactiv_id);

		$tipoactiv->tipoactiv_id	 = $tipoactiv_id;
		$tipoactiv->nombre	 = getField('tipoactiv_nombre', $tipoactiv_row);
		$tipoactiv->estado	 = getField('tipoactiv_estado', $tipoactiv_row);

		$tipoactiv_rs = $tipoactiv_dal->actualizar($tipoactiv);
		echo ($tipoactiv_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>