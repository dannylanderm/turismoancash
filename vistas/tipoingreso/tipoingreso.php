<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmTipoingreso' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Tipos de ingreso</span>
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
var frm_tipoing = '#frmTipoingreso';
$(document).ready(function(e){
	tipoing_mostrarDatos();
	$(frm_tipoing).find('#txtBuscar').focus();
	$(frm_tipoing).find('#txtBuscar').keyup(function(e) {
		tipoing_mostrarDatos();
	});
	$(frm_tipoing).find('#btnNuevo').off('click').click(function(e) {
		performLoad('tipoingreso/tipoingresoReg.php?parent=tipoingreso/tipoingreso.php');
	});
	$(frm_tipoing).find('#btnRefrescar').off('click').click(function(e) {
		tipoing_mostrarDatos();
	});
});
function tipoing_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tipoing).find('#datos').load('tipoingreso/tipoingresoList.php?b='+buscar);
}
function volver() {
	performLoad('tipoingreso/tipoingreso.php');
}
</script>