<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/objetoturistico.php';
	include_once '../../../includes/objetoturisticoDAL.php';
	
	if (isset($_POST['obj_id'])) {
		
		$obj_dal = new objetoturisticoDAL();
		$obj     = new objetoturistico();
		
		$obj_id  = $_POST['obj_id'];
		$obj_row = $obj_dal->getByID($obj_id);
		
		$foto_fullpath              = '';
		$obj_foto_contenido_deleted = $_POST['obj_foto_contenido_deleted'];
		if (IssetPostFile('obj_foto')) {
			$foto_fullpath = strtolower(IssetPostFile('obj_foto') ? "archivos/objetos/foto_{$obj_id}.".getPostFileExt('obj_foto') : '');
			move_uploaded_file($_FILES['obj_foto']['tmp_name'], "../../../$foto_fullpath");
		}
		
	
		
		
		$obj->obj_id         = $obj_id;
		$obj->nombre         = getField('obj_nombre', $obj_row);
		$obj->tipoobj_id     = getField('obj_tipoobj_id', $obj_row);
		$obj->foto           = $obj_foto_contenido_deleted ? '' : (IssetPostFile('obj_foto') ? $foto_fullpath : $obj_row['obj_foto']);
		$obj->comentario     = getField('obj_comentario', $obj_row);
		$obj->fecha_datacion = getField('obj_fecha_datacion', $obj_row);
		$obj->lug_id         = getField('obj_lug_id', $obj_row);
		$obj->situacion      = getField('obj_situacion', $obj_row);
		$obj->estado         = getField('obj_estado', $obj_row);
		
		$obj_rs = $obj_dal->actualizar($obj);
		echo ($obj_rs == 1) ? 1 : 'No se ha podido actualizar';
		
	} else {
		echo 'Ingrese datos validos';
	}
	function getField($campo, $row) {
		return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
	}

?>
