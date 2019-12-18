<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmRuta' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Rutas</span>
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
var frm_ruta = '#frmRuta';
$(document).ready(function(e){
	ruta_mostrarDatos();
	$(frm_ruta).find('#txtBuscar').focus();
	$(frm_ruta).find('#txtBuscar').keyup(function(e) {
		ruta_mostrarDatos();
	});
	$(frm_ruta).find('#btnNuevo').off('click').click(function(e) {
		performLoad('ruta/rutaReg.php?parent=ruta/ruta.php');
	});
	$(frm_ruta).find('#btnRefrescar').off('click').click(function(e) {
		ruta_mostrarDatos();
	});
});
function ruta_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_ruta).find('#datos').load('ruta/rutaList.php?b='+buscar);
}
function volver() {
	performLoad('ruta/ruta.php');
}
</script>