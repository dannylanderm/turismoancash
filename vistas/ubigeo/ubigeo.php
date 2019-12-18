<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmUbigeo' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Ubigeos</span>
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
var frm_ubig = '#frmUbigeo';
$(document).ready(function(e){
	ubig_mostrarDatos();
	$(frm_ubig).find('#txtBuscar').focus();
	$(frm_ubig).find('#txtBuscar').keyup(function(e) {
		ubig_mostrarDatos();
	});
	$(frm_ubig).find('#btnNuevo').off('click').click(function(e) {
		performLoad('ubigeo/ubigeoReg.php?parent=ubigeo/ubigeo.php');
	});
	$(frm_ubig).find('#btnRefrescar').off('click').click(function(e) {
		ubig_mostrarDatos();
	});
});
function ubig_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_ubig).find('#datos').load('ubigeo/ubigeoList.php?b='+buscar);
}
function volver() {
	performLoad('ubigeo/ubigeo.php');
}
</script>