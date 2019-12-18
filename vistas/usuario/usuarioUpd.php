<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('usu_upd', 'usuario/usuario.php');

	include_once '../../includes/usuarioDAL.php';
	$usu_dal = new usuarioDAL();
	$usu_id = GetNumericParam('usu_id');

	$usu_row = $usu_dal->getByID($usu_id);

	include_once '../../includes/personaDAL.php';
	$pers_dal = new personaDAL();

	include_once '../../includes/rolDAL.php';
	$rol_dal = new rolDAL();
?>
<form id='frmUsuarioUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar usuario</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUsuPersID'>Persona:</label></td>
		<td><select class='form-control txt200' id='txtUsuPersID' name='txtUsuPersID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo($usu_row['usu_pers_id']);  foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'
					<?php echo ($row['pers_id'] == $usu_row['pers_id']) ? 'selected' : '';  ?>>
					<?php echo $row['pers_nombres'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtUsuNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtUsuNombre' name='txtUsuNombre' value='<?php if ($usu_row) { echo htmlspecialchars($usu_row['usu_nombre']); } ?>' maxlength='30' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtUsuContrasena'>Contrasena:</label></td>
		<td><input type='password' id='txtUsuContrasena' name='txtUsuContrasena' value='' maxlength='32' placeholder='Ingrese contrasena'/></td>
	</tr>
	<tr><td><label for='txtUsuRolID'>Rol:</label></td>
		<td><select class='form-control txt200' id='txtUsuRolID' name='txtUsuRolID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $rol_list = $rol_dal->listarcbo($usu_row['usu_rol_id']);  foreach($rol_list as $row) { ?>
				<option value='<?php echo $row['rol_id']; ?>'
					<?php echo ($row['rol_id'] == $usu_row['rol_id']) ? 'selected' : '';  ?>>
					<?php echo $row['rol_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtUsuFechaAcceso'>Fecha acceso:</label></td>
		<td><input type='text' class='form-control txt200' id='txtUsuFechaAcceso' name='txtUsuFechaAcceso' value='<?php if ($usu_row) { echo formatDate($usu_row['usu_fecha_acceso']); } ?>'  placeholder='Ingrese fecha acceso'/></td>
	</tr>
	<tr hidden><td><label for='txtUsuEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtUsuEstado' name='txtUsuEstado' value='<?php if ($usu_row) { echo $usu_row['usu_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var usu_upd = '#frmUsuarioUpd';
$(document).ready(function(e) {
	$(usu_upd).find('#txtUsuPersID').focus();
	$(usu_upd).find('#btnActualizar').off('click').click(function(e) {
		if (usu_validar()) {
			var usu_id = '<?php echo $usu_id; ?>';
			var usu_pers_id = $(usu_upd).find('#txtUsuPersID').val();
			var usu_nombre = $(usu_upd).find('#txtUsuNombre').val();
			var usu_contrasena = $(usu_upd).find('#txtUsuContrasena').val();
			var usu_rol_id = $(usu_upd).find('#txtUsuRolID').val();
			var usu_fecha_acceso = getDateYMD($(usu_upd).find('#txtUsuFechaAcceso').val());
			var usu_estado = $(usu_upd).find('#txtUsuEstado').val();

			$.post('usuario/proceso/usuario_update.php',{
				usu_id : usu_id,
				usu_pers_id : usu_pers_id,
				usu_nombre : usu_nombre,
				usu_contrasena : usu_contrasena,
				usu_rol_id : usu_rol_id,
				usu_fecha_acceso : usu_fecha_acceso,
				usu_estado : usu_estado
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
	$(usu_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function usu_validar() {
	var usu_pers_id = $(usu_upd).find('#txtUsuPersID').val();
	var usu_nombre = $(usu_upd).find('#txtUsuNombre').val();
	var usu_contrasena = $(usu_upd).find('#txtUsuContrasena').val();
	var usu_rol_id = $(usu_upd).find('#txtUsuRolID').val();
	var usu_fecha_acceso = $(usu_upd).find('#txtUsuFechaAcceso').val();

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