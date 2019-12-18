<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmTipoactividad' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Tipos de actividad</span>
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
	<div id='datos' class='centered pad8 rpad8' ></div>
</div>
</div>
<script>
var frm_tipoactiv = '#frmTipoactividad';
$(document).ready(function(e){
	tipoactiv_mostrarDatos();
	$(frm_tipoactiv).find('#txtBuscar').focus();
	$(frm_tipoactiv).find('#txtBuscar').keyup(function(e) {
		tipoactiv_mostrarDatos();
	});
	$(frm_tipoactiv).find('#btnNuevo').off('click').click(function(e) {
		performLoad('tipoactividad/tipoactividadReg.php?parent=tipoactividad/tipoactividad.php');
	});
	$(frm_tipoactiv).find('#btnRefrescar').off('click').click(function(e) {
		tipoactiv_mostrarDatos();
	});
});
function tipoactiv_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tipoactiv).find('#datos').load('tipoactividad/tipoactividadList.php?b='+buscar);
}
function volver() {
	performLoad('tipoactividad/tipoactividad.php');
}
</script>