<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('gal_upd', 'galeria/galeria.php');

	include_once '../../includes/galeriaDAL.php';
	$gal_dal = new galeriaDAL();
	$gal_id = GetNumericParam('gal_id');

	$gal_row = $gal_dal->getByID($gal_id);

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<form id='frmGaleriaUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar galería</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtGalLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtGalLugID' name='txtGalLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo($gal_row['gal_lug_id']);  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'
					<?php echo ($row['lug_id'] == $gal_row['lug_id']) ? 'selected' : '';  ?>>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtGalFoto'>Foto:</label></td>
		<td><input type='text' class='form-control txt200' id='txtGalFoto' name='txtGalFoto' value='<?php if ($gal_row) { echo htmlspecialchars($gal_row['gal_foto']); } ?>' maxlength='256' placeholder='Ingrese foto'/></td>
	</tr>
	<tr><td><label for='txtGalFotoDescripcion'>Foto descripcion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtGalFotoDescripcion' name='txtGalFotoDescripcion' value='<?php if ($gal_row) { echo htmlspecialchars($gal_row['gal_foto_descripcion']); } ?>' maxlength='500' placeholder='Ingrese foto descripcion'/></td>
	</tr>
	<tr hidden><td><label for='txtGalEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtGalEstado' name='txtGalEstado' value='<?php if ($gal_row) { echo $gal_row['gal_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var gal_upd = '#frmGaleriaUpd';
$(document).ready(function(e) {
	$(gal_upd).find('#txtGalLugID').focus();
	$(gal_upd).find('#btnActualizar').off('click').click(function(e) {
		if (gal_validar()) {
			var gal_id = '<?php echo $gal_id; ?>';
			var gal_lug_id = $(gal_upd).find('#txtGalLugID').val();
			var gal_foto = $(gal_upd).find('#txtGalFoto').val();
			var gal_foto_descripcion = $(gal_upd).find('#txtGalFotoDescripcion').val();
			var gal_estado = $(gal_upd).find('#txtGalEstado').val();

			$.post('galeria/proceso/galeria_update.php',{
				gal_id : gal_id,
				gal_lug_id : gal_lug_id,
				gal_foto : gal_foto,
				gal_foto_descripcion : gal_foto_descripcion,
				gal_estado : gal_estado
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
	$(gal_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function gal_validar() {
	var gal_lug_id = $(gal_upd).find('#txtGalLugID').val();
	var gal_foto = $(gal_upd).find('#txtGalFoto').val();
	var gal_foto_descripcion = $(gal_upd).find('#txtGalFotoDescripcion').val();

	if (!(isInteger(gal_lug_id) && gal_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtGalLugID');
		return false;
	}
	if (gal_foto == '') {
		showMessageWarning('Ingrese una <b>foto</b> válida', 'txtGalFoto');
		return false;
	}
	if (gal_foto_descripcion == '') {
		showMessageWarning('Ingrese una <b>foto descripcion</b> válida de galería', 'txtGalFotoDescripcion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>