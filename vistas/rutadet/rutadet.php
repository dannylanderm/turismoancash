<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmRutadet' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Detalles de ruta</span>
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
var frm_rutad = '#frmRutadet';
$(document).ready(function(e){
	rutad_mostrarDatos();
	$(frm_rutad).find('#txtBuscar').focus();
	$(frm_rutad).find('#txtBuscar').keyup(function(e) {
		rutad_mostrarDatos();
	});
	$(frm_rutad).find('#btnNuevo').off('click').click(function(e) {
		performLoad('rutadet/rutadetReg.php?parent=rutadet/rutadet.php');
	});
	$(frm_rutad).find('#btnRefrescar').off('click').click(function(e) {
		rutad_mostrarDatos();
	});
});
function rutad_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_rutad).find('#datos').load('rutadet/rutadetList.php?b='+buscar);
}
function volver() {
	performLoad('rutadet/rutadet.php');
}
</script>