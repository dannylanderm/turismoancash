<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('rutad_upd', 'rutadet/rutadet.php');

	include_once '../../includes/rutadetDAL.php';
	$rutad_dal = new rutadetDAL();
	$rutad_ruta_id = GetNumericParam('rutad_ruta_id');
	$rutad_lug_id = GetNumericParam('rutad_lug_id');
	$rutad_nro_ord = GetNumericParam('rutad_nro_ord');

	$rutad_row = $rutad_dal->getByID($rutad_ruta_id, $rutad_lug_id, $rutad_nro_ord);

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();

	include_once '../../includes/rutaDAL.php';
	$ruta_dal = new rutaDAL();
?>
<form id='frmRutadetUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar detalle de ruta</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtRutadRutaID'>Ruta:</label></td>
		<td><select class='form-control txt200' id='txtRutadRutaID' name='txtRutadRutaID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ruta_list = $ruta_dal->listarcbo($rutad_row['rutad_ruta_id']);  foreach($ruta_list as $row) { ?>
				<option value='<?php echo $row['ruta_id']; ?>'
					<?php echo ($row['ruta_id'] == $rutad_row['ruta_id']) ? 'selected' : '';  ?>>
					<?php echo $row['ruta_descripcion'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtRutadLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtRutadLugID' name='txtRutadLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo($rutad_row['rutad_lug_id']);  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'
					<?php echo ($row['lug_id'] == $rutad_row['lug_id']) ? 'selected' : '';  ?>>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtRutadNroOrd'>Nro ord:</label></td>
		<td><input type='text' class='form-control txt200' id='txtRutadNroOrd' name='txtRutadNroOrd' value='<?php if ($rutad_row) { echo $rutad_row['rutad_nro_ord']; } ?>' maxlength='10' placeholder='Ingrese nro ord'/></td>
	</tr>
	<tr><td><label for='txtRutadDistancia'>Distancia:</label></td>
		<td><input type='text' class='form-control txt200' id='txtRutadDistancia' name='txtRutadDistancia' value='<?php if ($rutad_row) { echo $rutad_row['rutad_distancia']; } ?>' maxlength='11' placeholder='Ingrese distancia'/></td>
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
var rutad_upd = '#frmRutadetUpd';
$(document).ready(function(e) {
	$(rutad_upd).find('#txtRutadRutaID').focus();
	$(rutad_upd).find('#btnActualizar').off('click').click(function(e) {
		if (rutad_validar()) {
			var rutad_ruta_id = '<?php echo $rutad_ruta_id; ?>';
			var rutad_lug_id = '<?php echo $rutad_lug_id; ?>';
			var rutad_nro_ord = '<?php echo $rutad_nro_ord; ?>';
			var rutad_distancia = $(rutad_upd).find('#txtRutadDistancia').val();

			$.post('rutadet/proceso/rutadet_update.php',{
				rutad_ruta_id : rutad_ruta_id,
				rutad_lug_id : rutad_lug_id,
				rutad_nro_ord : rutad_nro_ord,
				rutad_distancia : rutad_distancia
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
	$(rutad_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function rutad_validar() {
	var rutad_ruta_id = $(rutad_upd).find('#txtRutadRutaID').val();
	var rutad_lug_id = $(rutad_upd).find('#txtRutadLugID').val();
	var rutad_nro_ord = $(rutad_upd).find('#txtRutadNroOrd').val();
	var rutad_distancia = $(rutad_upd).find('#txtRutadDistancia').val();

	if (!(isInteger(rutad_ruta_id) && rutad_ruta_id > 0)) {
		showMessageWarning('Seleccione <b>ruta</b>', 'txtRutadRutaID');
		return false;
	}
	if (!(isInteger(rutad_lug_id) && rutad_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtRutadLugID');
		return false;
	}
	if (!isInteger(rutad_nro_ord)) {
		showMessageWarning('Ingrese <b>nro ord</b> válido', 'txtRutadNroOrd');
		return false;
	}
	if (!isNumeric(rutad_distancia)) {
		showMessageWarning('Ingrese <b>distancia</b> válido', 'txtRutadDistancia');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>