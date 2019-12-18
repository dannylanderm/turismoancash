<?php
	session_start();
	include_once '../../../includes/AppUtils.php';
	CheckLoginAccess();

	include_once '../../../entidades/usuario.php';
	include_once '../../../includes/usuarioDAL.php';

	if (isset($_POST['usu_id'])) {

		$usu_dal = new usuarioDAL();
		$usu = new usuario();

		$usu_id = $_POST['usu_id'];
		$usu_row = $usu_dal->getByID($usu_id);

		$usu->usu_id	 = $usu_id;
		$usu->pers_id	 = getField('usu_pers_id', $usu_row);
		$usu->nombre	 = getField('usu_nombre', $usu_row);
		$usu->contrasena	 = getField('usu_contrasena', $usu_row);
		$usu->rol_id	 = getField('usu_rol_id', $usu_row);
		$usu->fecha_acceso	 = getField('usu_fecha_acceso', $usu_row);
		$usu->estado	 = getField('usu_estado', $usu_row);

		$usu_rs = $usu_dal->actualizar($usu);
		echo ($usu_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
