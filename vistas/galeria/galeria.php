<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmGaleria' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Galerías</span>
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
var frm_gal = '#frmGaleria';
$(document).ready(function(e){
	gal_mostrarDatos();
	$(frm_gal).find('#txtBuscar').focus();
	$(frm_gal).find('#txtBuscar').keyup(function(e) {
		gal_mostrarDatos();
	});
	$(frm_gal).find('#btnNuevo').off('click').click(function(e) {
		performLoad('galeria/galeriaReg.php?parent=galeria/galeria.php');
	});
	$(frm_gal).find('#btnRefrescar').off('click').click(function(e) {
		gal_mostrarDatos();
	});
});
function gal_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_gal).find('#datos').load('galeria/galeriaList.php?b='+buscar);
}
function volver() {
	performLoad('galeria/galeria.php');
}
</script>