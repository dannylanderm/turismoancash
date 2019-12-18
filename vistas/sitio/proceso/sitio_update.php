<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/sitio.php';
	include_once '../../../includes/sitioDAL.php';

	if (isset($_POST['sitio_id'])) {

		$sitio_dal = new sitioDAL();
		$sitio = new sitio();

		$sitio_id = $_POST['sitio_id'];
		$sitio_row = $sitio_dal->getByID($sitio_id);

		$sitio->sitio_id	 = $sitio_id;
		$sitio->nombre	 = getField('sitio_nombre', $sitio_row);
		$sitio->tipositio_id	 = getField('sitio_tipositio_id', $sitio_row);
		$sitio->latitud_geo	 = getField('sitio_latitud_geo', $sitio_row);
		$sitio->longitud_geo	 = getField('sitio_longitud_geo', $sitio_row);
		$sitio->celular	 = getField('sitio_celular', $sitio_row);
		$sitio->telefono	 = getField('sitio_telefono', $sitio_row);
		$sitio->webpage	 = getField('sitio_webpage', $sitio_row);
		$sitio->ubig_id	 = getField('sitio_ubig_id', $sitio_row);
		$sitio->direccion	 = getField('sitio_direccion', $sitio_row);
		$sitio->calificacion	 = getField('sitio_calificacion', $sitio_row);
		$sitio->situacion	 = getField('sitio_situacion', $sitio_row);
		$sitio->estado	 = getField('sitio_estado', $sitio_row);

		$sitio_rs = $sitio_dal->actualizar($sitio);
		echo ($sitio_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>