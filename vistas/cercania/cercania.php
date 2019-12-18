<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmCercania' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Cercanías</span>
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
var frm_cerca = '#frmCercania';
$(document).ready(function(e){
	cerca_mostrarDatos();
	$(frm_cerca).find('#txtBuscar').focus();
	$(frm_cerca).find('#txtBuscar').keyup(function(e) {
		cerca_mostrarDatos();
	});
	$(frm_cerca).find('#btnNuevo').off('click').click(function(e) {
		performLoad('cercania/cercaniaReg.php?parent=cercania/cercania.php');
	});
	$(frm_cerca).find('#btnRefrescar').off('click').click(function(e) {
		cerca_mostrarDatos();
	});
});
function cerca_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_cerca).find('#datos').load('cercania/cercaniaList.php?b='+buscar);
}
function volver() {
	performLoad('cercania/cercania.php');
}
</script>