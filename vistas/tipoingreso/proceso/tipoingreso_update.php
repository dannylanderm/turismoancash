<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/tipoingreso.php';
	include_once '../../../includes/tipoingresoDAL.php';

	if (isset($_POST['tipoing_id'])) {

		$tipoing_dal = new tipoingresoDAL();
		$tipoing = new tipoingreso();

		$tipoing_id = $_POST['tipoing_id'];
		$tipoing_row = $tipoing_dal->getByID($tipoing_id);

		$tipoing->tipoing_id	 = $tipoing_id;
		$tipoing->nombre	 = getField('tipoing_nombre', $tipoing_row);
		$tipoing->estado	 = getField('tipoing_estado', $tipoing_row);

		$tipoing_rs = $tipoing_dal->actualizar($tipoing);
		echo ($tipoing_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>