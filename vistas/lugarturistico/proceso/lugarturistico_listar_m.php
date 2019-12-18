<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	// CheckLoginAccess();
?>
<?php
	include_once '../../../includes/lugarturisticoDAL.php';
	
	if (isset($_GET['b']) && isset($_GET['app_token'])) {
		$token = $_GET['app_token'];
		
		if ($token == md5(APP_TOKEN)) {
			$lug_dal = new lugarturisticoDAL();
			$busca   = $_GET['b'];
			$lug_rs  = $lug_dal->m_listar($busca);
			
			echo $lug_rs ? json_encode($lug_rs, JSON_UNESCAPED_UNICODE) : '';
			save_file("..", "json.txt", json_encode($lug_rs, JSON_UNESCAPED_UNICODE));
			
		} else {
			echo "Token de seguridad no válido";
		}
	} else {
		echo 'Ingrese datos validos';
	}

	
	// token: 86199ec397e4afe5e8bb67aa82ba429e
