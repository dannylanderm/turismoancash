<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('tipoactiv_upd', 'tipoactividad/tipoactividad.php');

	include_once '../../includes/tipoactividadDAL.php';
	$tipoactiv_dal = new tipoactividadDAL();
	$tipoactiv_id = GetNumericParam('tipoactiv_id');

	$tipoactiv_row = $tipoactiv_dal->getByID($tipoactiv_id);
?>
<form id='frmTipoactividadUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar tipo de actividad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipoactivNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtTipoactivNombre' name='txtTipoactivNombre' value='<?php if ($tipoactiv_row) { echo htmlspecialchars($tipoactiv_row['tipoactiv_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtTipoactivEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtTipoactivEstado' name='txtTipoactivEstado' value='<?php if ($tipoactiv_row) { echo $tipoactiv_row['tipoactiv_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var tipoactiv_upd = '#frmTipoactividadUpd';
$(document).ready(function(e) {
	$(tipoactiv_upd).find('#txtTipoactivNombre').focus();
	$(tipoactiv_upd).find('#btnActualizar').off('click').click(function(e) {
		if (tipoactiv_validar()) {
			var tipoactiv_id = '<?php echo $tipoactiv_id; ?>';
			var tipoactiv_nombre = $(tipoactiv_upd).find('#txtTipoactivNombre').val();
			var tipoactiv_estado = $(tipoactiv_upd).find('#txtTipoactivEstado').val();

			$.post('tipoactividad/proceso/tipoactividad_update.php',{
				tipoactiv_id : tipoactiv_id,
				tipoactiv_nombre : tipoactiv_nombre,
				tipoactiv_estado : tipoactiv_estado
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
	$(tipoactiv_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipoactiv_validar() {
	var tipoactiv_nombre = $(tipoactiv_upd).find('#txtTipoactivNombre').val();

	if (tipoactiv_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo de actividad', 'txtTipoactivNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>