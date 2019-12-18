<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmRol' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Roles</span>
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
var frm_rol = '#frmRol';
$(document).ready(function(e){
	rol_mostrarDatos();
	$(frm_rol).find('#txtBuscar').focus();
	$(frm_rol).find('#txtBuscar').keyup(function(e) {
		rol_mostrarDatos();
	});
	$(frm_rol).find('#btnNuevo').off('click').click(function(e) {
		performLoad('rol/rolReg.php?parent=rol/rol.php');
	});
	$(frm_rol).find('#btnRefrescar').off('click').click(function(e) {
		rol_mostrarDatos();
	});
});
function rol_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_rol).find('#datos').load('rol/rolList.php?b='+buscar);
}
function volver() {
	performLoad('rol/rol.php');
}
</script>