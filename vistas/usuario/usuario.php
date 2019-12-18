<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmUsuario' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Usuarios</span>
	<hr class='separator'/>
	<div>
	<label for='txtBuscar'>Buscar:</label>
	<input type='text' class='form-control txt300 inline' id='txtBuscar' name='txtBuscar' placeholder='Ingrese búsqueda' />
	<a href='#' class='btn btn-default' id='btnRefrescar' name='btnRefrescar'>
		<img class='icon' src='../resources/img/refresh.png'>
	</a>
	<a href='#' class='btn btn-default' id='btnNuevo' name='btnNuevo'>Nuevo</a>
</div>
</div>
<hr class='separator'/>
<div class='listform_body bpad15'>
	<div id='datos' class='centered'></div>
</div>
</div>
<script>
var frm_usu = '#frmUsuario';
$(document).ready(function(e){
	usu_mostrarDatos();
	$(frm_usu).find('#txtBuscar').focus();
	$(frm_usu).find('#txtBuscar').keyup(function(e) {
		usu_mostrarDatos();
	});
	$(frm_usu).find('#btnNuevo').off('click').click(function(e) {
		performLoad('usuario/usuarioReg.php?parent=usuario/usuario.php');
	});
	$(frm_usu).find('#btnRefrescar').off('click').click(function(e) {
		usu_mostrarDatos();
	});
});
function usu_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_usu).find('#datos').load('usuario/usuarioList.php?b='+buscar);
}
function volver() {
	performLoad('usuario/usuario.php');
}
</script>