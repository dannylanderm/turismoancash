<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tipoing_upd', 'tipoingreso/tipoingreso.php');
?>
<?php
	include_once '../../includes/tipoingresoDAL.php';
	$tipoing_dal = new tipoingresoDAL();
	$tipoing_id = GetNumericParam('tipoing_id');

	$tipoing_row = $tipoing_dal->getByID($tipoing_id);
?>
<form id='frmTipoingresoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar tipo de ingreso</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipoingNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTipoingNombre' name='txtTipoingNombre' value='<?php if ($tipoing_row) { echo htmlspecialchars($tipoing_row['tipoing_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtTipoingEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTipoingEstado' name='txtTipoingEstado' value='<?php if ($tipoing_row) { echo $tipoing_row['tipoing_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var tipoing_upd = '#frmTipoingresoUpd';
$(document).ready(function(e) {
	$(tipoing_upd).find('#txtTipoingNombre').focus();
	$(tipoing_upd).find('#btnActualizar').off('click').click(function(e) {
		if (tipoing_validar()) {
			var tipoing_id = '<?php echo $tipoing_id; ?>';
			var tipoing_nombre = $(tipoing_upd).find('#txtTipoingNombre').val();
			var tipoing_estado = $(tipoing_upd).find('#txtTipoingEstado').val();

			$.post('tipoingreso/proceso/tipoingreso_update.php',{
				tipoing_id : tipoing_id,
				tipoing_nombre : tipoing_nombre,
				tipoing_estado : tipoing_estado
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
	$(tipoing_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipoing_validar() {
	var tipoing_nombre = $(tipoing_upd).find('#txtTipoingNombre').val();

	if (tipoing_nombre == '') {
		alert('Ingrese una nombre válida de tipo de ingreso');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>