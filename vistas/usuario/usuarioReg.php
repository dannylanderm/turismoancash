<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('usu_reg', 'usuario/usuario.php');

	include_once '../../includes/personaDAL.php';
	$pers_dal = new personaDAL();

	include_once '../../includes/rolDAL.php';
	$rol_dal = new rolDAL();
?>
<form id='frmUsuarioReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar usuario</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUsuPersID'>Persona:</label></td>
		<td><select class='form-control txt200' id='txtUsuPersID' name='txtUsuPersID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo();  foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'>
					<?php echo $row['pers_nombres'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtUsuNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtUsuNombre' name='txtUsuNombre' maxlength='30' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtUsuContrasena'>Contrasena:</label></td>
		<td><input type='text' class='form-control txt200' id='txtUsuContrasena' name='txtUsuContrasena' maxlength='32' placeholder='Ingrese contrasena'/></td>
	</tr>
	<tr><td><label for='txtUsuRolID'>Rol:</label></td>
		<td><select class='form-control txt200' id='txtUsuRolID' name='txtUsuRolID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $rol_list = $rol_dal->listarcbo();  foreach($rol_list as $row) { ?>
				<option value='<?php echo $row['rol_id']; ?>'>
					<?php echo $row['rol_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtUsuFechaAcceso'>Fecha acceso:</label></td>
		<td><input type='text' class='form-control txt200' id='txtUsuFechaAcceso' name='txtUsuFechaAcceso'  placeholder='Ingrese fecha acceso'/></td>
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
var usu_reg = '#frmUsuarioReg';
$(document).ready(function(e) {
	$(usu_reg).find('#txtUsuPersID').focus();
	$(usu_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (usu_validar()){
			var usu_pers_id = $(usu_reg).find('#txtUsuPersID').val();
			var usu_nombre = $(usu_reg).find('#txtUsuNombre').val();
			var usu_contrasena = $(usu_reg).find('#txtUsuContrasena').val();
			var usu_rol_id = $(usu_reg).find('#txtUsuRolID').val();
			var usu_fecha_acceso = getDateYMD($(usu_reg).find('#txtUsuFechaAcceso').val());

			$.post('usuario/proceso/usuario_insert.php',{
				usu_pers_id : usu_pers_id,
				usu_nombre : usu_nombre,
				usu_contrasena : usu_contrasena,
				usu_rol_id : usu_rol_id,
				usu_fecha_acceso : usu_fecha_acceso
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
	$(usu_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function usu_validar() {
	var usu_pers_id = $(usu_reg).find('#txtUsuPersID').val();
	var usu_nombre = $(usu_reg).find('#txtUsuNombre').val();
	var usu_contrasena = $(usu_reg).find('#txtUsuContrasena').val();
	var usu_rol_id = $(usu_reg).find('#txtUsuRolID').val();
	var usu_fecha_acceso = $(usu_reg).find('#txtUsuFechaAcceso').val();

	if (!(isInteger(usu_pers_id) && usu_pers_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtUsuPersID');
		return false;
	}
	if (usu_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de usuario', 'txtUsuNombre');
		return false;
	}
	if (usu_contrasena == '') {
		showMessageWarning('Ingrese una <b>contrasena</b> válida', 'txtUsuContrasena');
		return false;
	}
	if (!(isInteger(usu_rol_id) && usu_rol_id > 0)) {
		showMessageWarning('Seleccione <b>rol</b>', 'txtUsuRolID');
		return false;
	}
	if (!isDate(usu_fecha_acceso)) {
		showMessageWarning('Ingrese una <b>fecha acceso</b> válida', 'txtUsuFechaAcceso');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>