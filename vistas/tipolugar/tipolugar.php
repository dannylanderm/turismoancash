<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmTipolugar' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Tipos de lugar</span>
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
var frm_tipolug = '#frmTipolugar';
$(document).ready(function(e){
	tipolug_mostrarDatos();
	$(frm_tipolug).find('#txtBuscar').focus();
	$(frm_tipolug).find('#txtBuscar').keyup(function(e) {
		tipolug_mostrarDatos();
	});
	$(frm_tipolug).find('#btnNuevo').off('click').click(function(e) {
		performLoad('tipolugar/tipolugarReg.php?parent=tipolugar/tipolugar.php');
	});
	$(frm_tipolug).find('#btnRefrescar').off('click').click(function(e) {
		tipolug_mostrarDatos();
	});
});
function tipolug_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tipolug).find('#datos').load('tipolugar/tipolugarList.php?b='+buscar);
}
function volver() {
	performLoad('tipolugar/tipolugar.php');
}
</script>