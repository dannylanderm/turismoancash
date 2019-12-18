<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/lugarturisticoDAL.php';
	
	if (isset($_GET['lug_id']) && isset($_GET['app_token'])) {
		$token = $_GET['app_token'];
		
		if ($token == md5(APP_TOKEN)) {
			$lug_dal    = new lugarturisticoDAL();
			$lug_id     = $_GET['lug_id'];
			$buscar     = isset($_GET['b']) ? $_GET['b'] : '';
			$cerca_list = $lug_dal->getSitiosCercanos($lug_id, $buscar);
			
			echo json_encode($cerca_list);
		} else {
			echo "Token de seguridad no válido";
		}
	} else {
		echo 'Ingrese datos validos';
	}
