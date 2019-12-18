<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('rol_upd', 'rol/rol.php');
?>
<?php
	include_once '../../includes/rolDAL.php';
	$rol_dal = new rolDAL();
	$rol_id = GetNumericParam('rol_id');

	$rol_row = $rol_dal->getByID($rol_id);
?>
<form id='frmRolUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar rol</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtRolNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtRolNombre' name='txtRolNombre' value='<?php if ($rol_row) { echo htmlspecialchars($rol_row['rol_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtRolEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt250' id='txtRolEstado' name='txtRolEstado' value='<?php if ($rol_row) { echo $rol_row['rol_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var rol_upd = '#frmRolUpd';
$(document).ready(function(e) {
	$(rol_upd).find('#txtRolNombre').focus();
	$(rol_upd).find('#btnActualizar').off('click').click(function(e) {
		if (rol_validar()) {
			var rol_id = '<?php echo $rol_id; ?>';
			var rol_nombre = $(rol_upd).find('#txtRolNombre').val();
			var rol_estado = $(rol_upd).find('#txtRolEstado').val();

			$.post('rol/proceso/rol_update.php',{
				rol_id : rol_id,
				rol_nombre : rol_nombre,
				rol_estado : rol_estado
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
	$(rol_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function rol_validar() {
	var rol_nombre = $(rol_upd).find('#txtRolNombre').val();

	if (rol_nombre == '') {
		alert('Ingrese una nombre válida de rol');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>