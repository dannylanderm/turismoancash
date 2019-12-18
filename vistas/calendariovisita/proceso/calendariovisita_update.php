<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/calendariovisita.php';
	include_once '../../../includes/calendariovisitaDAL.php';

	if (isset($_POST['calend_id'])) {

		$calend_dal = new calendariovisitaDAL();
		$calend = new calendariovisita();

		$calend_id = $_POST['calend_id'];
		$calend_row = $calend_dal->getByID($calend_id);

		$calend->calend_id	 = $calend_id;
		$calend->lug_id	 = getField('calend_lug_id', $calend_row);
		$calend->nro	 = getField('calend_nro', $calend_row);
		$calend->fecha_ini	 = getField('calend_fecha_ini', $calend_row);
		$calend->fecha_fin	 = getField('calend_fecha_fin', $calend_row);
		$calend->hora_ini	 = getField('calend_hora_ini', $calend_row);
		$calend->hora_fin	 = getField('calend_hora_fin', $calend_row);
		$calend->situacion	 = getField('calend_situacion', $calend_row);
		$calend->estado	 = getField('calend_estado', $calend_row);

		$calend_rs = $calend_dal->actualizar($calend);
		echo ($calend_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>