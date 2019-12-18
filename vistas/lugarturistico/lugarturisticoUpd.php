<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('lug_upd', 'lugarturistico/lugarturistico.php');

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
	$lug_id = GetNumericParam('lug_id');

	$lug_row = $lug_dal->getByID($lug_id);

	include_once '../../includes/tipoingresoDAL.php';
	$tipoing_dal = new tipoingresoDAL();

	include_once '../../includes/tipolugarDAL.php';
	$tipolug_dal = new tipolugarDAL();

	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmLugarturisticoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar lugar turístico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtLugNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugNombre' name='txtLugNombre' value='<?php if ($lug_row) { echo htmlspecialchars($lug_row['lug_nombre']); } ?>' maxlength='100' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtLugTipolugID'>Tipo de lugar:</label></td>
		<td><select class='form-control txt200' id='txtLugTipolugID' name='txtLugTipolugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipolug_list = $tipolug_dal->listarcbo($lug_row['lug_tipolug_id']);  foreach($tipolug_list as $row) { ?>
				<option value='<?php echo $row['tipolug_id']; ?>'
					<?php echo ($row['tipolug_id'] == $lug_row['tipolug_id']) ? 'selected' : '';  ?>>
					<?php echo $row['tipolug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtLugLatitudGeo'>Latitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugLatitudGeo' name='txtLugLatitudGeo' value='<?php if ($lug_row) { echo $lug_row['lug_latitud_geo']; } ?>' maxlength='16' placeholder='Ingrese latitud geo'/></td>
	</tr>
	<tr><td><label for='txtLugLongitudGeo'>Longitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugLongitudGeo' name='txtLugLongitudGeo' value='<?php if ($lug_row) { echo $lug_row['lug_longitud_geo']; } ?>' maxlength='16' placeholder='Ingrese longitud geo'/></td>
	</tr>
	<tr><td><label for='txtLugAltitud'>Altitud:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugAltitud' name='txtLugAltitud' value='<?php if ($lug_row) { echo $lug_row['lug_altitud']; } ?>' maxlength='9' placeholder='Ingrese altitud'/></td>
	</tr>
	<tr><td><label for='txtLugTamanioArea'>Tamanio area:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugTamanioArea' name='txtLugTamanioArea' value='<?php if ($lug_row) { echo $lug_row['lug_tamanio_area']; } ?>' maxlength='9' placeholder='Ingrese tamanio area'/></td>
	</tr>
	<tr><td><label for='txtLugFoto'>Foto:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugFoto' name='txtLugFoto' value='<?php if ($lug_row) { echo htmlspecialchars($lug_row['lug_foto']); } ?>' maxlength='256' placeholder='Ingrese foto'/></td>
	</tr>
	<tr><td><label for='txtLugDescripcion'>Descripcion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugDescripcion' name='txtLugDescripcion' value='<?php if ($lug_row) { echo htmlspecialchars($lug_row['lug_descripcion']); } ?>' maxlength='400' placeholder='Ingrese descripcion'/></td>
	</tr>
	<tr><td><label for='txtLugUbigID'>Ubigeo:</label></td>
		<td><select class='form-control txt200' id='txtLugUbigID' name='txtLugUbigID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo($lug_row['lug_ubig_id']);  foreach($ubig_list as $row) { ?>
				<option value='<?php echo $row['ubig_id']; ?>'
					<?php echo ($row['ubig_id'] == $lug_row['ubig_id']) ? 'selected' : '';  ?>>
					<?php echo $row['ubig_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtLugDireccionRef'>Direccion ref:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugDireccionRef' name='txtLugDireccionRef' value='<?php if ($lug_row) { echo htmlspecialchars($lug_row['lug_direccion_ref']); } ?>' maxlength='100' placeholder='Ingrese direccion ref'/></td>
	</tr>
	<tr><td><label for='txtLugTipoingID'>Tipo de ingreso:</label></td>
		<td><select class='form-control txt200' id='txtLugTipoingID' name='txtLugTipoingID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipoing_list = $tipoing_dal->listarcbo($lug_row['lug_tipoing_id']);  foreach($tipoing_list as $row) { ?>
				<option value='<?php echo $row['tipoing_id']; ?>'
					<?php echo ($row['tipoing_id'] == $lug_row['tipoing_id']) ? 'selected' : '';  ?>>
					<?php echo $row['tipoing_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtLugCalificacion'>Calificacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugCalificacion' name='txtLugCalificacion' value='<?php if ($lug_row) { echo $lug_row['lug_calificacion']; } ?>'  placeholder='Ingrese calificacion'/></td>
	</tr>
	<tr><td><label for='txtLugSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugSituacion' name='txtLugSituacion' value='<?php if ($lug_row) { echo $lug_row['lug_situacion']; } ?>'  placeholder='Ingrese situacion'/></td>
	</tr>
	<tr><td><label for='txtLugResenia'>Resenia:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugResenia' name='txtLugResenia' value='<?php if ($lug_row) { echo htmlspecialchars($lug_row['lug_resenia']); } ?>' maxlength='500' placeholder='Ingrese resenia'/></td>
	</tr>
	<tr hidden><td><label for='txtLugEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugEstado' name='txtLugEstado' value='<?php if ($lug_row) { echo $lug_row['lug_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var lug_upd = '#frmLugarturisticoUpd';
$(document).ready(function(e) {
	$(lug_upd).find('#txtLugNombre').focus();
	$(lug_upd).find('#btnActualizar').off('click').click(function(e) {
		if (lug_validar()) {
			var lug_id = '<?php echo $lug_id; ?>';
			var lug_nombre = $(lug_upd).find('#txtLugNombre').val();
			var lug_tipolug_id = $(lug_upd).find('#txtLugTipolugID').val();
			var lug_latitud_geo = $(lug_upd).find('#txtLugLatitudGeo').val();
			var lug_longitud_geo = $(lug_upd).find('#txtLugLongitudGeo').val();
			var lug_altitud = $(lug_upd).find('#txtLugAltitud').val();
			var lug_tamanio_area = $(lug_upd).find('#txtLugTamanioArea').val();
			var lug_foto = $(lug_upd).find('#txtLugFoto').val();
			var lug_descripcion = $(lug_upd).find('#txtLugDescripcion').val();
			var lug_ubig_id = $(lug_upd).find('#txtLugUbigID').val();
			var lug_direccion_ref = $(lug_upd).find('#txtLugDireccionRef').val();
			var lug_tipoing_id = $(lug_upd).find('#txtLugTipoingID').val();
			var lug_calificacion = $(lug_upd).find('#txtLugCalificacion').val();
			var lug_situacion = $(lug_upd).find('#txtLugSituacion').val();
			var lug_resenia = $(lug_upd).find('#txtLugResenia').val();
			var lug_estado = $(lug_upd).find('#txtLugEstado').val();

			$.post('lugarturistico/proceso/lugarturistico_update.php',{
				lug_id : lug_id,
				lug_nombre : lug_nombre,
				lug_tipolug_id : lug_tipolug_id,
				lug_latitud_geo : lug_latitud_geo,
				lug_longitud_geo : lug_longitud_geo,
				lug_altitud : lug_altitud,
				lug_tamanio_area : lug_tamanio_area,
				lug_foto : lug_foto,
				lug_descripcion : lug_descripcion,
				lug_ubig_id : lug_ubig_id,
				lug_direccion_ref : lug_direccion_ref,
				lug_tipoing_id : lug_tipoing_id,
				lug_calificacion : lug_calificacion,
				lug_situacion : lug_situacion,
				lug_resenia : lug_resenia,
				lug_estado : lug_estado
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
	$(lug_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function lug_validar() {
	var lug_nombre = $(lug_upd).find('#txtLugNombre').val();
	var lug_tipolug_id = $(lug_upd).find('#txtLugTipolugID').val();
	var lug_latitud_geo = $(lug_upd).find('#txtLugLatitudGeo').val();
	var lug_longitud_geo = $(lug_upd).find('#txtLugLongitudGeo').val();
	var lug_altitud = $(lug_upd).find('#txtLugAltitud').val();
	var lug_tamanio_area = $(lug_upd).find('#txtLugTamanioArea').val();
	var lug_foto = $(lug_upd).find('#txtLugFoto').val();
	var lug_descripcion = $(lug_upd).find('#txtLugDescripcion').val();
	var lug_ubig_id = $(lug_upd).find('#txtLugUbigID').val();
	var lug_direccion_ref = $(lug_upd).find('#txtLugDireccionRef').val();
	var lug_tipoing_id = $(lug_upd).find('#txtLugTipoingID').val();
	var lug_calificacion = $(lug_upd).find('#txtLugCalificacion').val();
	var lug_situacion = $(lug_upd).find('#txtLugSituacion').val();
	var lug_resenia = $(lug_upd).find('#txtLugResenia').val();

	if (lug_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de lugar turístico', 'txtLugNombre');
		return false;
	}
	if (!(isInteger(lug_tipolug_id) && lug_tipolug_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de lugar</b>', 'txtLugTipolugID');
		return false;
	}
	if (!isNumeric(lug_latitud_geo)) {
		showMessageWarning('Ingrese <b>latitud geo</b> válido', 'txtLugLatitudGeo');
		return false;
	}
	if (!isNumeric(lug_longitud_geo)) {
		showMessageWarning('Ingrese <b>longitud geo</b> válido', 'txtLugLongitudGeo');
		return false;
	}
	if (!isNumeric(lug_altitud)) {
		showMessageWarning('Ingrese <b>altitud</b> válido', 'txtLugAltitud');
		return false;
	}
	if (!isNumeric(lug_tamanio_area)) {
		showMessageWarning('Ingrese <b>tamanio area</b> válido', 'txtLugTamanioArea');
		return false;
	}
	if (lug_foto == '') {
		showMessageWarning('Ingrese una <b>foto</b> válida', 'txtLugFoto');
		return false;
	}
	if (lug_descripcion == '') {
		showMessageWarning('Ingrese una <b>descripcion</b> válida de lugar turístico', 'txtLugDescripcion');
		return false;
	}
	if (!(isInteger(lug_ubig_id) && lug_ubig_id > 0)) {
		showMessageWarning('Seleccione <b>ubigeo</b>', 'txtLugUbigID');
		return false;
	}
	if (lug_direccion_ref == '') {
		showMessageWarning('Ingrese una <b>direccion ref</b> válida', 'txtLugDireccionRef');
		return false;
	}
	if (!(isInteger(lug_tipoing_id) && lug_tipoing_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de ingreso</b>', 'txtLugTipoingID');
		return false;
	}
	if (!isTinyint(lug_calificacion)) {
		showMessageWarning('Ingrese un valor de <b>calificacion</b> válido', 'txtLugCalificacion');
		return false;
	}
	if (!isTinyint(lug_situacion)) {
		showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtLugSituacion');
		return false;
	}
	if (lug_resenia == '') {
		showMessageWarning('Ingrese una <b>resenia</b> válida', 'txtLugResenia');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>