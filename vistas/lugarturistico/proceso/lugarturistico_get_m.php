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
			$lug_dal = new lugarturisticoDAL();
			$lug_id  = $_GET['lug_id'];
			$lug_row = $lug_dal->getByID($lug_id);
			
			$img_file = $lug_row['lug_foto'];
			
			$path = "../../../$img_file";
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			
			$lug_row['lug_foto_raw_header']  = 'data:image/'.$type.';base64,';
			$lug_row['lug_foto_raw_content'] = base64_encode($data);
			echo json_encode($lug_row);
		} else {
			echo "Token de seguridad no válido";
		}
	} else {
		echo 'Ingrese datos validos';
	}
