<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/sitio.php';
	include_once '../../../includes/sitioDAL.php';

	if (isset($_POST['sitio_nombre'], $_POST['sitio_tipositio_id'], $_POST['sitio_latitud_geo'], $_POST['sitio_longitud_geo'], $_POST['sitio_celular'], $_POST['sitio_telefono'], $_POST['sitio_webpage'], $_POST['sitio_ubig_id'], $_POST['sitio_direccion'], $_POST['sitio_calificacion'], $_POST['sitio_situacion'])){

		$sitio_dal = new sitioDAL();
		$sitio = new sitio();

		$sitio->nombre = $_POST['sitio_nombre'];
		$sitio->tipositio_id = $_POST['sitio_tipositio_id'];
		$sitio->latitud_geo = $_POST['sitio_latitud_geo'];
		$sitio->longitud_geo = $_POST['sitio_longitud_geo'];
		$sitio->celular = $_POST['sitio_celular'];
		$sitio->telefono = $_POST['sitio_telefono'];
		$sitio->webpage = $_POST['sitio_webpage'];
		$sitio->ubig_id = $_POST['sitio_ubig_id'];
		$sitio->direccion = $_POST['sitio_direccion'];
		$sitio->calificacion = $_POST['sitio_calificacion'];
		$sitio->situacion = $_POST['sitio_situacion'];

		$sitio_rs = $sitio_dal->registrar($sitio);
		echo ($sitio_rs > 0) ? $sitio_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>