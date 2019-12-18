<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('sitio_upd', 'sitio/sitio.php');

	include_once '../../includes/sitioDAL.php';
	$sitio_dal = new sitioDAL();
	$sitio_id = GetNumericParam('sitio_id');

	$sitio_row = $sitio_dal->getByID($sitio_id);

	include_once '../../includes/tipositioDAL.php';
	$tipositio_dal = new tipositioDAL();

	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmSitioUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar sitio</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtSitioNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioNombre' name='txtSitioNombre' value='<?php if ($sitio_row) { echo htmlspecialchars($sitio_row['sitio_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtSitioTipositioID'>Tipo de sitio:</label></td>
		<td><select class='form-control txt200' id='txtSitioTipositioID' name='txtSitioTipositioID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipositio_list = $tipositio_dal->listarcbo($sitio_row['sitio_tipositio_id']);  foreach($tipositio_list as $row) { ?>
				<option value='<?php echo $row['tipositio_id']; ?>'
					<?php echo ($row['tipositio_id'] == $sitio_row['tipositio_id']) ? 'selected' : '';  ?>>
					<?php echo $row['tipositio_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtSitioLatitudGeo'>Latitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioLatitudGeo' name='txtSitioLatitudGeo' value='<?php if ($sitio_row) { echo $sitio_row['sitio_latitud_geo']; } ?>' maxlength='16' placeholder='Ingrese latitud geo'/></td>
	</tr>
	<tr><td><label for='txtSitioLongitudGeo'>Longitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioLongitudGeo' name='txtSitioLongitudGeo' value='<?php if ($sitio_row) { echo $sitio_row['sitio_longitud_geo']; } ?>' maxlength='16' placeholder='Ingrese longitud geo'/></td>
	</tr>
	<tr><td><label for='txtSitioCelular'>Celular:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioCelular' name='txtSitioCelular' value='<?php if ($sitio_row) { echo htmlspecialchars($sitio_row['sitio_celular']); } ?>' maxlength='50' placeholder='Ingrese celular'/></td>
	</tr>
	<tr><td><label for='txtSitioTelefono'>Telefono:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioTelefono' name='txtSitioTelefono' value='<?php if ($sitio_row) { echo htmlspecialchars($sitio_row['sitio_telefono']); } ?>' maxlength='50' placeholder='Ingrese telefono'/></td>
	</tr>
	<tr><td><label for='txtSitioWebpage'>Webpage:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioWebpage' name='txtSitioWebpage' value='<?php if ($sitio_row) { echo htmlspecialchars($sitio_row['sitio_webpage']); } ?>' maxlength='100' placeholder='Ingrese webpage'/></td>
	</tr>
	<tr><td><label for='txtSitioUbigID'>Ubigeo:</label></td>
		<td><select class='form-control txt200' id='txtSitioUbigID' name='txtSitioUbigID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo($sitio_row['sitio_ubig_id']);  foreach($ubig_list as $row) { ?>
				<option value='<?php echo $row['ubig_id']; ?>'
					<?php echo ($row['ubig_id'] == $sitio_row['ubig_id']) ? 'selected' : '';  ?>>
					<?php echo $row['ubig_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtSitioDireccion'>Direccion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioDireccion' name='txtSitioDireccion' value='<?php if ($sitio_row) { echo htmlspecialchars($sitio_row['sitio_direccion']); } ?>' maxlength='100' placeholder='Ingrese direccion'/></td>
	</tr>
	<tr><td><label for='txtSitioCalificacion'>Calificacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioCalificacion' name='txtSitioCalificacion' value='<?php if ($sitio_row) { echo $sitio_row['sitio_calificacion']; } ?>'  placeholder='Ingrese calificacion'/></td>
	</tr>
	<tr><td><label for='txtSitioSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioSituacion' name='txtSitioSituacion' value='<?php if ($sitio_row) { echo $sitio_row['sitio_situacion']; } ?>'  placeholder='Ingrese situacion'/></td>
	</tr>
	<tr hidden><td><label for='txtSitioEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioEstado' name='txtSitioEstado' value='<?php if ($sitio_row) { echo $sitio_row['sitio_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var sitio_upd = '#frmSitioUpd';
$(document).ready(function(e) {
	$(sitio_upd).find('#txtSitioNombre').focus();
	$(sitio_upd).find('#btnActualizar').off('click').click(function(e) {
		if (sitio_validar()) {
			var sitio_id = '<?php echo $sitio_id; ?>';
			var sitio_nombre = $(sitio_upd).find('#txtSitioNombre').val();
			var sitio_tipositio_id = $(sitio_upd).find('#txtSitioTipositioID').val();
			var sitio_latitud_geo = $(sitio_upd).find('#txtSitioLatitudGeo').val();
			var sitio_longitud_geo = $(sitio_upd).find('#txtSitioLongitudGeo').val();
			var sitio_celular = $(sitio_upd).find('#txtSitioCelular').val();
			var sitio_telefono = $(sitio_upd).find('#txtSitioTelefono').val();
			var sitio_webpage = $(sitio_upd).find('#txtSitioWebpage').val();
			var sitio_ubig_id = $(sitio_upd).find('#txtSitioUbigID').val();
			var sitio_direccion = $(sitio_upd).find('#txtSitioDireccion').val();
			var sitio_calificacion = $(sitio_upd).find('#txtSitioCalificacion').val();
			var sitio_situacion = $(sitio_upd).find('#txtSitioSituacion').val();
			var sitio_estado = $(sitio_upd).find('#txtSitioEstado').val();

			$.post('sitio/proceso/sitio_update.php',{
				sitio_id : sitio_id,
				sitio_nombre : sitio_nombre,
				sitio_tipositio_id : sitio_tipositio_id,
				sitio_latitud_geo : sitio_latitud_geo,
				sitio_longitud_geo : sitio_longitud_geo,
				sitio_celular : sitio_celular,
				sitio_telefono : sitio_telefono,
				sitio_webpage : sitio_webpage,
				sitio_ubig_id : sitio_ubig_id,
				sitio_direccion : sitio_direccion,
				sitio_calificacion : sitio_calificacion,
				sitio_situacion : sitio_situacion,
				sitio_estado : sitio_estado
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
	$(sitio_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function sitio_validar() {
	var sitio_nombre = $(sitio_upd).find('#txtSitioNombre').val();
	var sitio_tipositio_id = $(sitio_upd).find('#txtSitioTipositioID').val();
	var sitio_latitud_geo = $(sitio_upd).find('#txtSitioLatitudGeo').val();
	var sitio_longitud_geo = $(sitio_upd).find('#txtSitioLongitudGeo').val();
	var sitio_celular = $(sitio_upd).find('#txtSitioCelular').val();
	var sitio_telefono = $(sitio_upd).find('#txtSitioTelefono').val();
	var sitio_webpage = $(sitio_upd).find('#txtSitioWebpage').val();
	var sitio_ubig_id = $(sitio_upd).find('#txtSitioUbigID').val();
	var sitio_direccion = $(sitio_upd).find('#txtSitioDireccion').val();
	var sitio_calificacion = $(sitio_upd).find('#txtSitioCalificacion').val();
	var sitio_situacion = $(sitio_upd).find('#txtSitioSituacion').val();

	if (sitio_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de sitio', 'txtSitioNombre');
		return false;
	}
	if (!(isInteger(sitio_tipositio_id) && sitio_tipositio_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de sitio</b>', 'txtSitioTipositioID');
		return false;
	}
	if (!isNumeric(sitio_latitud_geo)) {
		showMessageWarning('Ingrese <b>latitud geo</b> válido', 'txtSitioLatitudGeo');
		return false;
	}
	if (!isNumeric(sitio_longitud_geo)) {
		showMessageWarning('Ingrese <b>longitud geo</b> válido', 'txtSitioLongitudGeo');
		return false;
	}
	if (sitio_celular == '') {
		showMessageWarning('Ingrese una <b>celular</b> válida', 'txtSitioCelular');
		return false;
	}
	if (sitio_telefono == '') {
		showMessageWarning('Ingrese una <b>telefono</b> válida', 'txtSitioTelefono');
		return false;
	}
	if (sitio_webpage == '') {
		showMessageWarning('Ingrese una <b>webpage</b> válida', 'txtSitioWebpage');
		return false;
	}
	if (!(isInteger(sitio_ubig_id) && sitio_ubig_id > 0)) {
		showMessageWarning('Seleccione <b>ubigeo</b>', 'txtSitioUbigID');
		return false;
	}
	if (sitio_direccion == '') {
		showMessageWarning('Ingrese una <b>direccion</b> válida', 'txtSitioDireccion');
		return false;
	}
	if (!isTinyint(sitio_calificacion)) {
		showMessageWarning('Ingrese un valor de <b>calificacion</b> válido', 'txtSitioCalificacion');
		return false;
	}
	if (!isTinyint(sitio_situacion)) {
		showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtSitioSituacion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>