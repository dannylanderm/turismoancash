<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmPersona' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Personas</span>
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
var frm_pers = '#frmPersona';
$(document).ready(function(e){
	pers_mostrarDatos();
	$(frm_pers).find('#txtBuscar').focus();
	$(frm_pers).find('#txtBuscar').keyup(function(e) {
		pers_mostrarDatos();
	});
	$(frm_pers).find('#btnNuevo').off('click').click(function(e) {
		performLoad('persona/personaReg.php?parent=persona/persona.php');
	});
	$(frm_pers).find('#btnRefrescar').off('click').click(function(e) {
		pers_mostrarDatos();
	});
});
function pers_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_pers).find('#datos').load('persona/personaList.php?b='+buscar);
}
function volver() {
	performLoad('persona/persona.php');
}
</script>