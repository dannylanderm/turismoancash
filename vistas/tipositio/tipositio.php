<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<div id='frmTipositio' class='txt_center'>
<div class='form_top'>
	<span class='h1'>Tipos de sitio</span>
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
var frm_tipositio = '#frmTipositio';
$(document).ready(function(e){
	tipositio_mostrarDatos();
	$(frm_tipositio).find('#txtBuscar').focus();
	$(frm_tipositio).find('#txtBuscar').keyup(function(e) {
		tipositio_mostrarDatos();
	});
	$(frm_tipositio).find('#btnNuevo').off('click').click(function(e) {
		performLoad('tipositio/tipositioReg.php?parent=tipositio/tipositio.php');
	});
	$(frm_tipositio).find('#btnRefrescar').off('click').click(function(e) {
		tipositio_mostrarDatos();
	});
});
function tipositio_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tipositio).find('#datos').load('tipositio/tipositioList.php?b='+buscar);
}
function volver() {
	performLoad('tipositio/tipositio.php');
}
</script>