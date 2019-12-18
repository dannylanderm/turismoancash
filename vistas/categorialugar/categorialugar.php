<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmCategorialugar' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Categorías de lugar</span>
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
<div class='txt_center bpad15'>
	<div id='datos' class='centered pad8 rpad8' ></div>
</div>
</div>
<script>
var frm_catlug = '#frmCategorialugar';
$(document).ready(function(e){
	catlug_mostrarDatos();
	$(frm_catlug).find('#txtBuscar').focus();
	$(frm_catlug).find('#txtBuscar').keyup(function(e) {
		catlug_mostrarDatos();
	});
	$(frm_catlug).find('#btnNuevo').off('click').click(function(e) {
		performLoad('categorialugar/categorialugarReg.php?parent=categorialugar/categorialugar.php');
	});
	$(frm_catlug).find('#btnRefrescar').off('click').click(function(e) {
		catlug_mostrarDatos();
	});
});
function catlug_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_catlug).find('#datos').load('categorialugar/categorialugarList.php?b='+buscar);
}
function volver() {
	performLoad('categorialugar/categorialugar.php');
}
</script>