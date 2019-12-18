<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/tipositioDAL.php';
	
	if (isset($_GET['app_token'])) {
		$token = $_GET['app_token'];
		
		if ($token == md5(APP_TOKEN)) {
			$tipositio_dal  = new tipositioDAL();
			$tipositio_list = $tipositio_dal->listar();
			
			echo json_encode($tipositio_list);
		} else {
			echo "Token de seguridad no válido";
		}
		
	} else {
		echo 'Ingrese datos validos';
	}
