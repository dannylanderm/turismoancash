<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();
?>
<div id='frmCalendariovisita' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Calendarios de visita</span>
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
var frm_calend = '#frmCalendariovisita';
$(document).ready(function(e){
	calend_mostrarDatos();
	$(frm_calend).find('#txtBuscar').focus();
	$(frm_calend).find('#txtBuscar').keyup(function(e) {
		calend_mostrarDatos();
	});
	$(frm_calend).find('#btnNuevo').off('click').click(function(e) {
		performLoad('calendariovisita/calendariovisitaReg.php?parent=calendariovisita/calendariovisita.php');
	});
	$(frm_calend).find('#btnRefrescar').off('click').click(function(e) {
		calend_mostrarDatos();
	});
});
function calend_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_calend).find('#datos').load('calendariovisita/calendariovisitaList.php?b='+buscar);
}
function volver() {
	performLoad('calendariovisita/calendariovisita.php');
}
</script>