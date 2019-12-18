<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('sitio_reg', 'sitio/sitio.php');

	include_once '../../includes/tipositioDAL.php';
	$tipositio_dal = new tipositioDAL();

	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmSitioReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar sitio</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtSitioNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioNombre' name='txtSitioNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtSitioTipositioID'>Tipo de sitio:</label></td>
		<td><select class='form-control txt200' id='txtSitioTipositioID' name='txtSitioTipositioID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipositio_list = $tipositio_dal->listarcbo();  foreach($tipositio_list as $row) { ?>
				<option value='<?php echo $row['tipositio_id']; ?>'>
					<?php echo $row['tipositio_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtSitioLatitudGeo'>Latitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioLatitudGeo' name='txtSitioLatitudGeo' maxlength='16' placeholder='Ingrese latitud geo'/></td>
	</tr>
	<tr><td><label for='txtSitioLongitudGeo'>Longitud geo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioLongitudGeo' name='txtSitioLongitudGeo' maxlength='16' placeholder='Ingrese longitud geo'/></td>
	</tr>
	<tr><td><label for='txtSitioCelular'>Celular:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioCelular' name='txtSitioCelular' maxlength='50' placeholder='Ingrese celular'/></td>
	</tr>
	<tr><td><label for='txtSitioTelefono'>Telefono:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioTelefono' name='txtSitioTelefono' maxlength='50' placeholder='Ingrese telefono'/></td>
	</tr>
	<tr><td><label for='txtSitioWebpage'>Webpage:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioWebpage' name='txtSitioWebpage' maxlength='100' placeholder='Ingrese webpage'/></td>
	</tr>
	<tr><td><label for='txtSitioUbigID'>Ubigeo:</label></td>
		<td><select class='form-control txt200' id='txtSitioUbigID' name='txtSitioUbigID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo();  foreach($ubig_list as $row) { ?>
				<option value='<?php echo $row['ubig_id']; ?>'>
					<?php echo $row['ubig_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtSitioDireccion'>Direccion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioDireccion' name='txtSitioDireccion' maxlength='100' placeholder='Ingrese direccion'/></td>
	</tr>
	<tr><td><label for='txtSitioCalificacion'>Calificacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioCalificacion' name='txtSitioCalificacion'  placeholder='Ingrese calificacion'/></td>
	</tr>
	<tr><td><label for='txtSitioSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtSitioSituacion' name='txtSitioSituacion'  placeholder='Ingrese situacion'/></td>
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
var sitio_reg = '#frmSitioReg';
$(document).ready(function(e) {
	$(sitio_reg).find('#txtSitioNombre').focus();
	$(sitio_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (sitio_validar()){
			var sitio_nombre = $(sitio_reg).find('#txtSitioNombre').val();
			var sitio_tipositio_id = $(sitio_reg).find('#txtSitioTipositioID').val();
			var sitio_latitud_geo = $(sitio_reg).find('#txtSitioLatitudGeo').val();
			var sitio_longitud_geo = $(sitio_reg).find('#txtSitioLongitudGeo').val();
			var sitio_celular = $(sitio_reg).find('#txtSitioCelular').val();
			var sitio_telefono = $(sitio_reg).find('#txtSitioTelefono').val();
			var sitio_webpage = $(sitio_reg).find('#txtSitioWebpage').val();
			var sitio_ubig_id = $(sitio_reg).find('#txtSitioUbigID').val();
			var sitio_direccion = $(sitio_reg).find('#txtSitioDireccion').val();
			var sitio_calificacion = $(sitio_reg).find('#txtSitioCalificacion').val();
			var sitio_situacion = $(sitio_reg).find('#txtSitioSituacion').val();

			$.post('sitio/proceso/sitio_insert.php',{
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
				sitio_situacion : sitio_situacion
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
	$(sitio_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function sitio_validar() {
	var sitio_nombre = $(sitio_reg).find('#txtSitioNombre').val();
	var sitio_tipositio_id = $(sitio_reg).find('#txtSitioTipositioID').val();
	var sitio_latitud_geo = $(sitio_reg).find('#txtSitioLatitudGeo').val();
	var sitio_longitud_geo = $(sitio_reg).find('#txtSitioLongitudGeo').val();
	var sitio_celular = $(sitio_reg).find('#txtSitioCelular').val();
	var sitio_telefono = $(sitio_reg).find('#txtSitioTelefono').val();
	var sitio_webpage = $(sitio_reg).find('#txtSitioWebpage').val();
	var sitio_ubig_id = $(sitio_reg).find('#txtSitioUbigID').val();
	var sitio_direccion = $(sitio_reg).find('#txtSitioDireccion').val();
	var sitio_calificacion = $(sitio_reg).find('#txtSitioCalificacion').val();
	var sitio_situacion = $(sitio_reg).find('#txtSitioSituacion').val();

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