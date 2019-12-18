<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../includes/objetoturisticoDAL.php';
	
	if (isset($_GET['obj_id']) && isset($_GET['app_token'])) {
		$token = $_GET['app_token'];
		
		if ($token == md5(APP_TOKEN)) {
			$obj_dal = new objetoturisticoDAL();
			$obj_id  = $_GET['obj_id'];
			$obj_row = $obj_dal->getByID($obj_id);
			
			$img_file = $obj_row['obj_foto'];
			
			if ($img_file) {
				$path = "../../../$img_file";
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				
				$obj_row['obj_foto_raw_header']  = 'data:image/'.$type.';base64,';
				$obj_row['obj_foto_raw_content'] = base64_encode($data);
			} else {
				$obj_row['obj_foto_raw_header']  = "";
				$obj_row['obj_foto_raw_content'] = "";
			}
			
			echo json_encode($obj_row);
		} else {
			echo "Token de seguridad no válido";
		}
	} else {
		echo 'Ingrese datos validos';
	}
