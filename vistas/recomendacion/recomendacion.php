<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmRecomendacion' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Recomendaciones</span>
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
var frm_rec = '#frmRecomendacion';
$(document).ready(function(e){
	rec_mostrarDatos();
	$(frm_rec).find('#txtBuscar').focus();
	$(frm_rec).find('#txtBuscar').keyup(function(e) {
		rec_mostrarDatos();
	});
	$(frm_rec).find('#btnNuevo').off('click').click(function(e) {
		performLoad('recomendacion/recomendacionReg.php?parent=recomendacion/recomendacion.php');
	});
	$(frm_rec).find('#btnRefrescar').off('click').click(function(e) {
		rec_mostrarDatos();
	});
});
function rec_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_rec).find('#datos').load('recomendacion/recomendacionList.php?b='+buscar);
}
function volver() {
	performLoad('recomendacion/recomendacion.php');
}
</script>