<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/lugarturistico.php';
	include_once '../../../includes/lugarturisticoDAL.php';
	
	if (isset($_POST['lug_nombre'], $_POST['lug_tipolug_id'], $_POST['lug_latitud_geo'], $_POST['lug_longitud_geo'],
		$_POST['lug_altitud'], $_POST['lug_tamanio_area'], $_POST['lug_descripcion'],
		$_POST['lug_ubig_id'], $_POST['lug_direccion_ref'], $_POST['lug_tipoing_id'], $_POST['lug_calificacion'],
		$_POST['lug_situacion'], $_POST['lug_resenia'])) {
		
		$lug_dal = new lugarturisticoDAL();
		$lug     = new lugarturistico();
		
		$lug->nombre        = $_POST['lug_nombre'];
		$lug->tipolug_id    = $_POST['lug_tipolug_id'];
		$lug->latitud_geo   = $_POST['lug_latitud_geo'];
		$lug->longitud_geo  = $_POST['lug_longitud_geo'];
		$lug->altitud       = $_POST['lug_altitud'];
		$lug->tamanio_area  = $_POST['lug_tamanio_area'];
		$lug->foto          = ''; // $_POST['lug_foto'];
		$lug->descripcion   = $_POST['lug_descripcion'];
		$lug->ubig_id       = $_POST['lug_ubig_id'];
		$lug->direccion_ref = $_POST['lug_direccion_ref'];
		$lug->tipoing_id    = $_POST['lug_tipoing_id'];
		$lug->calificacion  = $_POST['lug_calificacion'];
		$lug->situacion     = $_POST['lug_situacion'];
		$lug->resenia       = $_POST['lug_resenia'];
		
		$lug_id = $lug_dal->registrar($lug);
		
		if ($lug_id) {
			$foto_fullpath = strtolower(IssetPostFile('lug_foto') ? "archivos/foto_{$lug_id}.".getPostFileExt('lug_foto') : '');
			if (IssetPostFile('lug_foto')) {
				move_uploaded_file($_FILES['lug_foto']['tmp_name'], "../../../$foto_fullpath");
			}
			$lug->lug_id = $lug_id;
			$lug->foto   = $foto_fullpath;
			$lug_dal->actualizar($lug);
		}
		
		echo ($lug_id > 0) ? $lug_id : 'No se ha podido registrar';
		
	} else {
		echo 'Ingrese datos validos';
	}
?>