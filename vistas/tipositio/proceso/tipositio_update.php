<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/tipositio.php';
	include_once '../../../includes/tipositioDAL.php';

	if (isset($_POST['tipositio_id'])) {

		$tipositio_dal = new tipositioDAL();
		$tipositio = new tipositio();

		$tipositio_id = $_POST['tipositio_id'];
		$tipositio_row = $tipositio_dal->getByID($tipositio_id);

		$tipositio->tipositio_id	 = $tipositio_id;
		$tipositio->nombre	 = getField('tipositio_nombre', $tipositio_row);
		$tipositio->estado	 = getField('tipositio_estado', $tipositio_row);

		$tipositio_rs = $tipositio_dal->actualizar($tipositio);
		echo ($tipositio_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>