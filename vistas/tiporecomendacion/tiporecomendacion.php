<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmTiporecomendacion' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Tipos de recomendación</span>
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
var frm_tiporec = '#frmTiporecomendacion';
$(document).ready(function(e){
	tiporec_mostrarDatos();
	$(frm_tiporec).find('#txtBuscar').focus();
	$(frm_tiporec).find('#txtBuscar').keyup(function(e) {
		tiporec_mostrarDatos();
	});
	$(frm_tiporec).find('#btnNuevo').off('click').click(function(e) {
		performLoad('tiporecomendacion/tiporecomendacionReg.php?parent=tiporecomendacion/tiporecomendacion.php');
	});
	$(frm_tiporec).find('#btnRefrescar').off('click').click(function(e) {
		tiporec_mostrarDatos();
	});
});
function tiporec_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tiporec).find('#datos').load('tiporecomendacion/tiporecomendacionList.php?b='+buscar);
}
function volver() {
	performLoad('tiporecomendacion/tiporecomendacion.php');
}
</script>