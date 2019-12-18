<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/lugarturistico.php';
	include_once '../../../includes/lugarturisticoDAL.php';
	
	if (isset($_POST['lug_id'])) {
		
		$lug_dal = new lugarturisticoDAL();
		$lug     = new lugarturistico();
		
		$lug_id  = $_POST['lug_id'];
		$lug_row = $lug_dal->getByID($lug_id);
		
		$foto_fullpath              = '';
		$lug_foto_contenido_deleted = $_POST['lug_foto_contenido_deleted'];
		if (IssetPostFile('lug_foto')) {
			$foto_fullpath = strtolower(IssetPostFile('lug_foto') ? "archivos/foto_{$lug_id}.".getPostFileExt('lug_foto') : '');
			move_uploaded_file($_FILES['lug_foto']['tmp_name'], "../../../$foto_fullpath");
		}
		
		$lug->lug_id        = $lug_id;
		$lug->nombre        = getField('lug_nombre', $lug_row);
		$lug->tipolug_id    = getField('lug_tipolug_id', $lug_row);
		$lug->latitud_geo   = getField('lug_latitud_geo', $lug_row);
		$lug->longitud_geo  = getField('lug_longitud_geo', $lug_row);
		$lug->altitud       = getField('lug_altitud', $lug_row);
		$lug->tamanio_area  = getField('lug_tamanio_area', $lug_row);
		$lug->foto          = $lug_foto_contenido_deleted ? '' : (IssetPostFile('lug_foto') ? $foto_fullpath : $lug_row['lug_foto']);
		$lug->descripcion   = getField('lug_descripcion', $lug_row);
		$lug->ubig_id       = getField('lug_ubig_id', $lug_row);
		$lug->direccion_ref = getField('lug_direccion_ref', $lug_row);
		$lug->tipoing_id    = getField('lug_tipoing_id', $lug_row);
		$lug->calificacion  = getField('lug_calificacion', $lug_row);
		$lug->situacion     = getField('lug_situacion', $lug_row);
		$lug->resenia       = getField('lug_resenia', $lug_row);
		$lug->estado        = getField('lug_estado', $lug_row);
		
		$lug_rs = $lug_dal->actualizar($lug);
		echo ($lug_rs == 1) ? 1 : 'No se ha podido actualizar';
		
	} else {
		echo 'Ingrese datos validos';
	}
	function getField($campo, $row) {
		return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
	}

?>
