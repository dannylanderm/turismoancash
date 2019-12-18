<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmSitio' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Sitios</span>
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
var frm_sitio = '#frmSitio';
$(document).ready(function(e){
	sitio_mostrarDatos();
	$(frm_sitio).find('#txtBuscar').focus();
	$(frm_sitio).find('#txtBuscar').keyup(function(e) {
		sitio_mostrarDatos();
	});
	$(frm_sitio).find('#btnNuevo').off('click').click(function(e) {
		performLoad('sitio/sitioReg.php?parent=sitio/sitio.php');
	});
	$(frm_sitio).find('#btnRefrescar').off('click').click(function(e) {
		sitio_mostrarDatos();
	});
});
function sitio_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_sitio).find('#datos').load('sitio/sitioList.php?b='+buscar);
}
function volver() {
	performLoad('sitio/sitio.php');
}
</script>