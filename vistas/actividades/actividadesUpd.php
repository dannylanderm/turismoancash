<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('activ_upd', 'actividades/actividades.php');

	include_once '../../includes/actividadesDAL.php';
	$activ_dal = new actividadesDAL();
	$activ_lug_id = GetNumericParam('activ_lug_id');
	$activ_tipoactiv_id = GetNumericParam('activ_tipoactiv_id');

	$activ_row = $activ_dal->getByID($activ_lug_id, $activ_tipoactiv_id);

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();

	include_once '../../includes/tipoactividadDAL.php';
	$tipoactiv_dal = new tipoactividadDAL();
?>
<form id='frmActividadesUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar actividad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtActivLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtActivLugID' name='txtActivLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo($activ_row['activ_lug_id']);  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'
					<?php echo ($row['lug_id'] == $activ_row['lug_id']) ? 'selected' : '';  ?>>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtActivTipoactivID'>Tipo de actividad:</label></td>
		<td><select class='form-control txt200' id='txtActivTipoactivID' name='txtActivTipoactivID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipoactiv_list = $tipoactiv_dal->listarcbo($activ_row['activ_tipoactiv_id']);  foreach($tipoactiv_list as $row) { ?>
				<option value='<?php echo $row['tipoactiv_id']; ?>'
					<?php echo ($row['tipoactiv_id'] == $activ_row['tipoactiv_id']) ? 'selected' : '';  ?>>
					<?php echo $row['tipoactiv_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtActivSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtActivSituacion' name='txtActivSituacion' value='<?php if ($activ_row) { echo $activ_row['activ_situacion']; } ?>'  placeholder='Ingrese situacion'/></td>
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
var activ_upd = '#frmActividadesUpd';
$(document).ready(function(e) {
	$(activ_upd).find('#txtActivLugID').focus();
	$(activ_upd).find('#btnActualizar').off('click').click(function(e) {
		if (activ_validar()) {
			var activ_lug_id = '<?php echo $activ_lug_id; ?>';
			var activ_tipoactiv_id = '<?php echo $activ_tipoactiv_id; ?>';
			var activ_situacion = $(activ_upd).find('#txtActivSituacion').val();

			$.post('actividades/proceso/actividades_update.php',{
				activ_lug_id : activ_lug_id,
				activ_tipoactiv_id : activ_tipoactiv_id,
				activ_situacion : activ_situacion
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
	$(activ_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function activ_validar() {
	var activ_lug_id = $(activ_upd).find('#txtActivLugID').val();
	var activ_tipoactiv_id = $(activ_upd).find('#txtActivTipoactivID').val();
	var activ_situacion = $(activ_upd).find('#txtActivSituacion').val();

	if (!(isInteger(activ_lug_id) && activ_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtActivLugID');
		return false;
	}
	if (!(isInteger(activ_tipoactiv_id) && activ_tipoactiv_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de actividad</b>', 'txtActivTipoactivID');
		return false;
	}
	if (!isTinyint(activ_situacion)) {
		showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtActivSituacion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>