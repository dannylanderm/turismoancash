<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmObjetoturistico' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Objetos turísticos</span>
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
var frm_obj = '#frmObjetoturistico';
$(document).ready(function(e){
	obj_mostrarDatos();
	$(frm_obj).find('#txtBuscar').focus();
	$(frm_obj).find('#txtBuscar').keyup(function(e) {
		obj_mostrarDatos();
	});
	$(frm_obj).find('#btnNuevo').off('click').click(function(e) {
		performLoad('objetoturistico/objetoturisticoReg.php?parent=objetoturistico/objetoturistico.php');
	});
	$(frm_obj).find('#btnRefrescar').off('click').click(function(e) {
		obj_mostrarDatos();
	});
});
function obj_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_obj).find('#datos').load('objetoturistico/objetoturisticoList.php?b='+buscar);
}
function volver() {
	performLoad('objetoturistico/objetoturistico.php');
}
</script>