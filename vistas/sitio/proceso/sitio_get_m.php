<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/sitioDAL.php';
	
	if (isset($_GET['sitio_id']) && isset($_GET['app_token'])) {
		$token = $_GET['app_token'];
		
		if ($token == md5(APP_TOKEN)) {
			$sitio_dal = new sitioDAL();
			$sitio_id  = $_GET['sitio_id'];
			$sitio_row = $sitio_dal->getByID($sitio_id);
			
			echo json_encode($sitio_row);
		} else {
			echo "Token de seguridad no válido";
		}
		
	} else {
		echo 'Ingrese datos validos';
	}
