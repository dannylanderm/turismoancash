<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('calend_reg', 'calendariovisita/calendariovisita.php');

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<form id='frmCalendariovisitaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar calendario de visita</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCalendLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtCalendLugID' name='txtCalendLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo();  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtCalendNro'>Nro:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCalendNro' name='txtCalendNro' maxlength='10' placeholder='Ingrese nro'/></td>
	</tr>
	<tr><td><label for='txtCalendFechaIni'>Fecha ini:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCalendFechaIni' name='txtCalendFechaIni'  placeholder='Ingrese fecha ini'/></td>
	</tr>
	<tr><td><label for='txtCalendFechaFin'>Fecha fin:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCalendFechaFin' name='txtCalendFechaFin'  placeholder='Ingrese fecha fin'/></td>
	</tr>
	<tr><td><label for='txtCalendHoraIni'>Hora ini:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCalendHoraIni' name='txtCalendHoraIni'  placeholder='Ingrese hora ini'/></td>
	</tr>
	<tr><td><label for='txtCalendHoraFin'>Hora fin:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCalendHoraFin' name='txtCalendHoraFin'  placeholder='Ingrese hora fin'/></td>
	</tr>
	<tr><td><label for='txtCalendSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCalendSituacion' name='txtCalendSituacion'  placeholder='Ingrese situacion'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
	<input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
	<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var calend_reg = '#frmCalendariovisitaReg';
$(document).ready(function(e) {
	$(calend_reg).find('#txtCalendLugID').focus();
	$(calend_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (calend_validar()){
			var calend_lug_id = $(calend_reg).find('#txtCalendLugID').val();
			var calend_nro = $(calend_reg).find('#txtCalendNro').val();
			var calend_fecha_ini = getDateYMD($(calend_reg).find('#txtCalendFechaIni').val());
			var calend_fecha_fin = getDateYMD($(calend_reg).find('#txtCalendFechaFin').val());
			var calend_hora_ini = $(calend_reg).find('#txtCalendHoraIni').val();
			var calend_hora_fin = $(calend_reg).find('#txtCalendHoraFin').val();
			var calend_situacion = $(calend_reg).find('#txtCalendSituacion').val();

			$.post('calendariovisita/proceso/calendariovisita_insert.php',{
				calend_lug_id : calend_lug_id,
				calend_nro : calend_nro,
				calend_fecha_ini : calend_fecha_ini,
				calend_fecha_fin : calend_fecha_fin,
				calend_hora_ini : calend_hora_ini,
				calend_hora_fin : calend_hora_fin,
				calend_situacion : calend_situacion
			},
			function(datos) {
				if (datos > 0) {
					alert('Registro correcto');
					volver();
				} else {
					alert('Error al registrar. ' + datos);
				}
			});
		}
	});
	$(calend_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function calend_validar() {
	var calend_lug_id = $(calend_reg).find('#txtCalendLugID').val();
	var calend_nro = $(calend_reg).find('#txtCalendNro').val();
	var calend_fecha_ini = $(calend_reg).find('#txtCalendFechaIni').val();
	var calend_fecha_fin = $(calend_reg).find('#txtCalendFechaFin').val();
	var calend_hora_ini = $(calend_reg).find('#txtCalendHoraIni').val();
	var calend_hora_fin = $(calend_reg).find('#txtCalendHoraFin').val();
	var calend_situacion = $(calend_reg).find('#txtCalendSituacion').val();

	if (!(isInteger(calend_lug_id) && calend_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtCalendLugID');
		return false;
	}
	if (!isInteger(calend_nro)) {
		showMessageWarning('Ingrese <b>nro</b> válido', 'txtCalendNro');
		return false;
	}
	if (!isDate(calend_fecha_ini)) {
		showMessageWarning('Ingrese una <b>fecha ini</b> válida', 'txtCalendFechaIni');
		return false;
	}
	if (!isDate(calend_fecha_fin)) {
		showMessageWarning('Ingrese una <b>fecha fin</b> válida', 'txtCalendFechaFin');
		return false;
	}
	if (!isTinyint(calend_situacion)) {
		showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtCalendSituacion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>