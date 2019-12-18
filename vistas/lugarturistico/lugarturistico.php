<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmLugarturistico' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Lugares turísticos</span>
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
var frm_lug = '#frmLugarturistico';
$(document).ready(function(e){
	lug_mostrarDatos();
	$(frm_lug).find('#txtBuscar').focus();
	$(frm_lug).find('#txtBuscar').keyup(function(e) {
		lug_mostrarDatos();
	});
	$(frm_lug).find('#btnNuevo').off('click').click(function(e) {
		performLoad('lugarturistico/lugarturisticoReg.php?parent=lugarturistico/lugarturistico.php');
	});
	$(frm_lug).find('#btnRefrescar').off('click').click(function(e) {
		lug_mostrarDatos();
	});
});
function lug_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_lug).find('#datos').load('lugarturistico/lugarturisticoList.php?b='+buscar);
}
function volver() {
	performLoad('lugarturistico/lugarturistico.php');
}
</script>