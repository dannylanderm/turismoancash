<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tipositio_upd', 'tipositio/tipositio.php');
?>
<?php
	include_once '../../includes/tipositioDAL.php';
	$tipositio_dal = new tipositioDAL();
	$tipositio_id = GetNumericParam('tipositio_id');

	$tipositio_row = $tipositio_dal->getByID($tipositio_id);
?>
<form id='frmTipositioUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar tipo de sitio</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipositioNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTipositioNombre' name='txtTipositioNombre' value='<?php if ($tipositio_row) { echo htmlspecialchars($tipositio_row['tipositio_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtTipositioEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTipositioEstado' name='txtTipositioEstado' value='<?php if ($tipositio_row) { echo $tipositio_row['tipositio_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var tipositio_upd = '#frmTipositioUpd';
$(document).ready(function(e) {
	$(tipositio_upd).find('#txtTipositioNombre').focus();
	$(tipositio_upd).find('#btnActualizar').off('click').click(function(e) {
		if (tipositio_validar()) {
			var tipositio_id = '<?php echo $tipositio_id; ?>';
			var tipositio_nombre = $(tipositio_upd).find('#txtTipositioNombre').val();
			var tipositio_estado = $(tipositio_upd).find('#txtTipositioEstado').val();

			$.post('tipositio/proceso/tipositio_update.php',{
				tipositio_id : tipositio_id,
				tipositio_nombre : tipositio_nombre,
				tipositio_estado : tipositio_estado
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
	$(tipositio_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipositio_validar() {
	var tipositio_nombre = $(tipositio_upd).find('#txtTipositioNombre').val();

	if (tipositio_nombre == '') {
		alert('Ingrese una nombre válida de tipo de sitio');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>