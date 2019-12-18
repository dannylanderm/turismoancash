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
		$lug = new lugarturistico();

		$lug_id = $_POST['lug_id'];
		$lug_row = $lug_dal->getByID($lug_id);

		$lug->lug_id	 = $lug_id;
		$lug->nombre	 = getField('lug_nombre', $lug_row);
		$lug->tipolug_id	 = getField('lug_tipolug_id', $lug_row);
		$lug->latitud_geo	 = getField('lug_latitud_geo', $lug_row);
		$lug->longitud_geo	 = getField('lug_longitud_geo', $lug_row);
		$lug->altitud	 = getField('lug_altitud', $lug_row);
		$lug->tamanio_area	 = getField('lug_tamanio_area', $lug_row);
		$lug->foto	 = getField('lug_foto', $lug_row);
		$lug->descripcion	 = getField('lug_descripcion', $lug_row);
		$lug->ubig_id	 = getField('lug_ubig_id', $lug_row);
		$lug->direccion_ref	 = getField('lug_direccion_ref', $lug_row);
		$lug->tipoing_id	 = getField('lug_tipoing_id', $lug_row);
		$lug->calificacion	 = getField('lug_calificacion', $lug_row);
		$lug->situacion	 = getField('lug_situacion', $lug_row);
		$lug->resenia	 = getField('lug_resenia', $lug_row);
		$lug->estado	 = getField('lug_estado', $lug_row);

		$lug_rs = $lug_dal->actualizar($lug);
		echo ($lug_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>