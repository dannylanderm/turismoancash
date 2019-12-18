<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/cercania.php';
	include_once '../../../includes/cercaniaDAL.php';

	if (isset($_POST['cerca_lug_id'], $_POST['cerca_sitio_id'])) {

		$cerca_dal = new cercaniaDAL();
		$cerca = new cercania();

		$cerca_lug_id = $_POST['cerca_lug_id'];
		$cerca_sitio_id = $_POST['cerca_sitio_id'];
		$cerca_row = $cerca_dal->getByID($cerca_lug_id, $cerca_sitio_id);

		$cerca->lug_id	 = $cerca_lug_id;
		$cerca->sitio_id	 = $cerca_sitio_id;
		$cerca->distancia	 = getField('cerca_distancia', $cerca_row);

		$cerca_rs = $cerca_dal->actualizar($cerca);
		echo ($cerca_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>