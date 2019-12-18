<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmTipoobjetoturistico' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Tipos de objeto turístico</span>
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
var frm_tipoobj = '#frmTipoobjetoturistico';
$(document).ready(function(e){
	tipoobj_mostrarDatos();
	$(frm_tipoobj).find('#txtBuscar').focus();
	$(frm_tipoobj).find('#txtBuscar').keyup(function(e) {
		tipoobj_mostrarDatos();
	});
	$(frm_tipoobj).find('#btnNuevo').off('click').click(function(e) {
		performLoad('tipoobjetoturistico/tipoobjetoturisticoReg.php?parent=tipoobjetoturistico/tipoobjetoturistico.php');
	});
	$(frm_tipoobj).find('#btnRefrescar').off('click').click(function(e) {
		tipoobj_mostrarDatos();
	});
});
function tipoobj_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tipoobj).find('#datos').load('tipoobjetoturistico/tipoobjetoturisticoList.php?b='+buscar);
}
function volver() {
	performLoad('tipoobjetoturistico/tipoobjetoturistico.php');
}
</script>