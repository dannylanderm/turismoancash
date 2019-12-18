<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tiporec_upd', 'tiporecomendacion/tiporecomendacion.php');
?>
<?php
	include_once '../../includes/tiporecomendacionDAL.php';
	$tiporec_dal = new tiporecomendacionDAL();
	$tiporec_id = GetNumericParam('tiporec_id');

	$tiporec_row = $tiporec_dal->getByID($tiporec_id);
?>
<form id='frmTiporecomendacionUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar tipo de recomendación</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTiporecNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTiporecNombre' name='txtTiporecNombre' value='<?php if ($tiporec_row) { echo htmlspecialchars($tiporec_row['tiporec_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtTiporecEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTiporecEstado' name='txtTiporecEstado' value='<?php if ($tiporec_row) { echo $tiporec_row['tiporec_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var tiporec_upd = '#frmTiporecomendacionUpd';
$(document).ready(function(e) {
	$(tiporec_upd).find('#txtTiporecNombre').focus();
	$(tiporec_upd).find('#btnActualizar').off('click').click(function(e) {
		if (tiporec_validar()) {
			var tiporec_id = '<?php echo $tiporec_id; ?>';
			var tiporec_nombre = $(tiporec_upd).find('#txtTiporecNombre').val();
			var tiporec_estado = $(tiporec_upd).find('#txtTiporecEstado').val();

			$.post('tiporecomendacion/proceso/tiporecomendacion_update.php',{
				tiporec_id : tiporec_id,
				tiporec_nombre : tiporec_nombre,
				tiporec_estado : tiporec_estado
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
	$(tiporec_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tiporec_validar() {
	var tiporec_nombre = $(tiporec_upd).find('#txtTiporecNombre').val();

	if (tiporec_nombre == '') {
		alert('Ingrese una nombre válida de tipo de recomendación');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>