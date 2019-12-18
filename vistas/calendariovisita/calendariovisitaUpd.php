<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('calend_upd', 'calendariovisita/calendariovisita.php');
?>
<?php
	include_once '../../includes/calendariovisitaDAL.php';
	$calend_dal = new calendariovisitaDAL();
	$calend_id = GetNumericParam('calend_id');

	$calend_row = $calend_dal->getByID($calend_id);
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<form id='frmCalendariovisitaUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar calendario de visita</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCalendLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt250'  id='txtCalendLugID' name='txtCalendLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo($calend_row['calend_lug_id']); ?>
			<?php foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'
					<?php echo ($row['lug_id'] == $calend_row['lug_id']) ? 'selected' : '';  ?>>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtCalendNro'>Nro:</label></td>
		<td><input type='text' class='form-control txt250' id='txtCalendNro' name='txtCalendNro' value='<?php if ($calend_row) { echo $calend_row['calend_nro']; } ?>' maxlength='10' placeholder='Ingrese nro'/></td>
	</tr>
	<tr><td><label for='txtCalendFechaIni'>Fecha ini:</label></td>
		<td><input type='text' class='form-control txt250' id='txtCalendFechaIni' name='txtCalendFechaIni' value='<?php if ($calend_row) { echo formatDate($calend_row['calend_fecha_ini']); } ?>'  placeholder='Ingrese fecha ini'/></td>
	</tr>
	<tr><td><label for='txtCalendFechaFin'>Fecha fin:</label></td>
		<td><input type='text' class='form-control txt250' id='txtCalendFechaFin' name='txtCalendFechaFin' value='<?php if ($calend_row) { echo formatDate($calend_row['calend_fecha_fin']); } ?>'  placeholder='Ingrese fecha fin'/></td>
	</tr>
	<tr><td><label for='txtCalendHoraIni'>Hora ini:</label></td>
		<td><input type='text' class='form-control txt250' id='txtCalendHoraIni' name='txtCalendHoraIni' value='<?php if ($calend_row) { echo $calend_row['calend_hora_ini']; } ?>'  placeholder='Ingrese hora ini'/></td>
	</tr>
	<tr><td><label for='txtCalendHoraFin'>Hora fin:</label></td>
		<td><input type='text' class='form-control txt250' id='txtCalendHoraFin' name='txtCalendHoraFin' value='<?php if ($calend_row) { echo $calend_row['calend_hora_fin']; } ?>'  placeholder='Ingrese hora fin'/></td>
	</tr>
	<tr><td><label for='txtCalendSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt250' id='txtCalendSituacion' name='txtCalendSituacion' value='<?php if ($calend_row) { echo $calend_row['calend_situacion']; } ?>'  placeholder='Ingrese situacion'/></td>
	</tr>
	<tr hidden><td><label for='txtCalendEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt250' id='txtCalendEstado' name='txtCalendEstado' value='<?php if ($calend_row) { echo $calend_row['calend_estado']; } ?>'  placeholder='Ingrese estado'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
		<input class='btn b_naranja' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
		<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var calend_upd = '#frmCalendariovisitaUpd';
$(document).ready(function(e) {
	$(calend_upd).find('#txtCalendLugID').focus();
	$(calend_upd).find('#btnActualizar').off('click').click(function(e) {
		if (calend_validar()) {
			var calend_id = '<?php echo $calend_id; ?>';
			var calend_lug_id = $(calend_upd).find('#txtCalendLugID').val();
			var calend_nro = $(calend_upd).find('#txtCalendNro').val();
			var calend_fecha_ini = getDateYMD($(calend_upd).find('#txtCalendFechaIni').val());
			var calend_fecha_fin = getDateYMD($(calend_upd).find('#txtCalendFechaFin').val());
			var calend_hora_ini = $(calend_upd).find('#txtCalendHoraIni').val();
			var calend_hora_fin = $(calend_upd).find('#txtCalendHoraFin').val();
			var calend_situacion = $(calend_upd).find('#txtCalendSituacion').val();
			var calend_estado = $(calend_upd).find('#txtCalendEstado').val();

			$.post('calendariovisita/proceso/calendariovisita_update.php',{
				calend_id : calend_id,
				calend_lug_id : calend_lug_id,
				calend_nro : calend_nro,
				calend_fecha_ini : calend_fecha_ini,
				calend_fecha_fin : calend_fecha_fin,
				calend_hora_ini : calend_hora_ini,
				calend_hora_fin : calend_hora_fin,
				calend_situacion : calend_situacion,
				calend_estado : calend_estado
			},
			function(datos) {
				if (datos == 1){
					alert('Actualizacion correcta');
					volver();
				} else {
					alert('Error al actualizar. ' + datos);
				}
			});
		}
	});
	$(calend_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function calend_validar() {
	var calend_lug_id = $(calend_upd).find('#txtCalendLugID').val();
	var calend_nro = $(calend_upd).find('#txtCalendNro').val();
	var calend_fecha_ini = $(calend_upd).find('#txtCalendFechaIni').val();
	var calend_fecha_fin = $(calend_upd).find('#txtCalendFechaFin').val();
	var calend_hora_ini = $(calend_upd).find('#txtCalendHoraIni').val();
	var calend_hora_fin = $(calend_upd).find('#txtCalendHoraFin').val();
	var calend_situacion = $(calend_upd).find('#txtCalendSituacion').val();

	if (!(isInteger(calend_lug_id) && calend_lug_id > 0)) {
		alert('Seleccione lugar turístico');
		return false;
	}
	if (!isInteger(calend_nro)) {
		alert('Ingrese nro válido');
		return false;
	}
	if (!isDate(calend_fecha_ini)) {
		alert('Ingrese una fecha ini válida');
		return false;
	}
	if (!isDate(calend_fecha_fin)) {
		alert('Ingrese una fecha fin válida');
		return false;
	}
	if (!isTinyint(calend_situacion)) {
		alert('Ingrese un valor de situacion válido');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>