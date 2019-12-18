<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('cerca_upd', 'cercania/cercania.php');

	include_once '../../includes/cercaniaDAL.php';
	$cerca_dal = new cercaniaDAL();
	$cerca_lug_id = GetNumericParam('cerca_lug_id');
	$cerca_sitio_id = GetNumericParam('cerca_sitio_id');

	$cerca_row = $cerca_dal->getByID($cerca_lug_id, $cerca_sitio_id);

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();

	include_once '../../includes/sitioDAL.php';
	$sitio_dal = new sitioDAL();
?>
<form id='frmCercaniaUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar cercanía</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCercaLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtCercaLugID' name='txtCercaLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo($cerca_row['cerca_lug_id']);  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'
					<?php echo ($row['lug_id'] == $cerca_row['lug_id']) ? 'selected' : '';  ?>>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtCercaSitioID'>Sitio:</label></td>
		<td><select class='form-control txt200' id='txtCercaSitioID' name='txtCercaSitioID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $sitio_list = $sitio_dal->listarcbo($cerca_row['cerca_sitio_id']);  foreach($sitio_list as $row) { ?>
				<option value='<?php echo $row['sitio_id']; ?>'
					<?php echo ($row['sitio_id'] == $cerca_row['sitio_id']) ? 'selected' : '';  ?>>
					<?php echo $row['sitio_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtCercaDistancia'>Distancia:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCercaDistancia' name='txtCercaDistancia' value='<?php if ($cerca_row) { echo $cerca_row['cerca_distancia']; } ?>' maxlength='11' placeholder='Ingrese distancia'/></td>
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
var cerca_upd = '#frmCercaniaUpd';
$(document).ready(function(e) {
	$(cerca_upd).find('#txtCercaLugID').focus();
	$(cerca_upd).find('#btnActualizar').off('click').click(function(e) {
		if (cerca_validar()) {
			var cerca_lug_id = '<?php echo $cerca_lug_id; ?>';
			var cerca_sitio_id = '<?php echo $cerca_sitio_id; ?>';
			var cerca_distancia = $(cerca_upd).find('#txtCercaDistancia').val();

			$.post('cercania/proceso/cercania_update.php',{
				cerca_lug_id : cerca_lug_id,
				cerca_sitio_id : cerca_sitio_id,
				cerca_distancia : cerca_distancia
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
	$(cerca_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function cerca_validar() {
	var cerca_lug_id = $(cerca_upd).find('#txtCercaLugID').val();
	var cerca_sitio_id = $(cerca_upd).find('#txtCercaSitioID').val();
	var cerca_distancia = $(cerca_upd).find('#txtCercaDistancia').val();

	if (!(isInteger(cerca_lug_id) && cerca_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtCercaLugID');
		return false;
	}
	if (!(isInteger(cerca_sitio_id) && cerca_sitio_id > 0)) {
		showMessageWarning('Seleccione <b>sitio</b>', 'txtCercaSitioID');
		return false;
	}
	if (!isNumeric(cerca_distancia)) {
		showMessageWarning('Ingrese <b>distancia</b> válido', 'txtCercaDistancia');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>