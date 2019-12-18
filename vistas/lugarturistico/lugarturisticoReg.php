<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('lug_reg', 'lugarturistico/lugarturistico.php');

	include_once '../../includes/tipoingresoDAL.php';
	$tipoing_dal = new tipoingresoDAL();

	include_once '../../includes/tipolugarDAL.php';
	$tipolug_dal = new tipolugarDAL();

	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmLugarturisticoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar lugar turístico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtLugNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugNombre' name='txtLugNombre' maxlength='100' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtLugTipolugID'>Tipo de lugar:</label></td>
		<td><select class='form-control txt200' id='txtLugTipolugID' name='txtLugTipolugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipolug_list = $tipolug_dal->listarcbo();  foreach($tipolug_list as $row) { ?>
				<option value='<?php echo $row['tipolug_id']; ?>'>
					<?php echo $row['tipolug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtLugLatitudGeo'>Latitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugLatitudGeo' name='txtLugLatitudGeo' maxlength='16' placeholder='Ingrese latitud geo'/></td>
	</tr>
	<tr><td><label for='txtLugLongitudGeo'>Longitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugLongitudGeo' name='txtLugLongitudGeo' maxlength='16' placeholder='Ingrese longitud geo'/></td>
	</tr>
	<tr><td><label for='txtLugAltitud'>Altitud:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugAltitud' name='txtLugAltitud' maxlength='9' placeholder='Ingrese altitud'/></td>
	</tr>
	<tr><td><label for='txtLugTamanioArea'>Tamanio area:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugTamanioArea' name='txtLugTamanioArea' maxlength='9' placeholder='Ingrese tamanio area'/></td>
	</tr>
	<tr><td><label for='txtLugFoto'>Foto:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugFoto' name='txtLugFoto' maxlength='256' placeholder='Ingrese foto'/></td>
	</tr>
	<tr><td><label for='txtLugDescripcion'>Descripcion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugDescripcion' name='txtLugDescripcion' maxlength='400' placeholder='Ingrese descripcion'/></td>
	</tr>
	<tr><td><label for='txtLugUbigID'>Ubigeo:</label></td>
		<td><select class='form-control txt200' id='txtLugUbigID' name='txtLugUbigID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo();  foreach($ubig_list as $row) { ?>
				<option value='<?php echo $row['ubig_id']; ?>'>
					<?php echo $row['ubig_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtLugDireccionRef'>Direccion ref:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugDireccionRef' name='txtLugDireccionRef' maxlength='100' placeholder='Ingrese direccion ref'/></td>
	</tr>
	<tr><td><label for='txtLugTipoingID'>Tipo de ingreso:</label></td>
		<td><select class='form-control txt200' id='txtLugTipoingID' name='txtLugTipoingID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipoing_list = $tipoing_dal->listarcbo();  foreach($tipoing_list as $row) { ?>
				<option value='<?php echo $row['tipoing_id']; ?>'>
					<?php echo $row['tipoing_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtLugCalificacion'>Calificacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugCalificacion' name='txtLugCalificacion'  placeholder='Ingrese calificacion'/></td>
	</tr>
	<tr><td><label for='txtLugSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugSituacion' name='txtLugSituacion'  placeholder='Ingrese situacion'/></td>
	</tr>
	<tr><td><label for='txtLugResenia'>Resenia:</label></td>
		<td><input type='text' class='form-control txt200' id='txtLugResenia' name='txtLugResenia' maxlength='500' placeholder='Ingrese resenia'/></td>
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
var lug_reg = '#frmLugarturisticoReg';
$(document).ready(function(e) {
	$(lug_reg).find('#txtLugNombre').focus();
	$(lug_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (lug_validar()){
			var lug_nombre = $(lug_reg).find('#txtLugNombre').val();
			var lug_tipolug_id = $(lug_reg).find('#txtLugTipolugID').val();
			var lug_latitud_geo = $(lug_reg).find('#txtLugLatitudGeo').val();
			var lug_longitud_geo = $(lug_reg).find('#txtLugLongitudGeo').val();
			var lug_altitud = $(lug_reg).find('#txtLugAltitud').val();
			var lug_tamanio_area = $(lug_reg).find('#txtLugTamanioArea').val();
			var lug_foto = $(lug_reg).find('#txtLugFoto').val();
			var lug_descripcion = $(lug_reg).find('#txtLugDescripcion').val();
			var lug_ubig_id = $(lug_reg).find('#txtLugUbigID').val();
			var lug_direccion_ref = $(lug_reg).find('#txtLugDireccionRef').val();
			var lug_tipoing_id = $(lug_reg).find('#txtLugTipoingID').val();
			var lug_calificacion = $(lug_reg).find('#txtLugCalificacion').val();
			var lug_situacion = $(lug_reg).find('#txtLugSituacion').val();
			var lug_resenia = $(lug_reg).find('#txtLugResenia').val();

			$.post('lugarturistico/proceso/lugarturistico_insert.php',{
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
				lug_resenia : lug_resenia
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
	$(lug_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function lug_validar() {
	var lug_nombre = $(lug_reg).find('#txtLugNombre').val();
	var lug_tipolug_id = $(lug_reg).find('#txtLugTipolugID').val();
	var lug_latitud_geo = $(lug_reg).find('#txtLugLatitudGeo').val();
	var lug_longitud_geo = $(lug_reg).find('#txtLugLongitudGeo').val();
	var lug_altitud = $(lug_reg).find('#txtLugAltitud').val();
	var lug_tamanio_area = $(lug_reg).find('#txtLugTamanioArea').val();
	var lug_foto = $(lug_reg).find('#txtLugFoto').val();
	var lug_descripcion = $(lug_reg).find('#txtLugDescripcion').val();
	var lug_ubig_id = $(lug_reg).find('#txtLugUbigID').val();
	var lug_direccion_ref = $(lug_reg).find('#txtLugDireccionRef').val();
	var lug_tipoing_id = $(lug_reg).find('#txtLugTipoingID').val();
	var lug_calificacion = $(lug_reg).find('#txtLugCalificacion').val();
	var lug_situacion = $(lug_reg).find('#txtLugSituacion').val();
	var lug_resenia = $(lug_reg).find('#txtLugResenia').val();

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