<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('catlug_upd', 'categorialugar/categorialugar.php');

	include_once '../../includes/categorialugarDAL.php';
	$catlug_dal = new categorialugarDAL();
	$catlug_id = GetNumericParam('catlug_id');

	$catlug_row = $catlug_dal->getByID($catlug_id);
?>
<form id='frmCategorialugarUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar categoría de lugar</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCatlugNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCatlugNombre' name='txtCatlugNombre' value='<?php if ($catlug_row) { echo htmlspecialchars($catlug_row['catlug_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtCatlugEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCatlugEstado' name='txtCatlugEstado' value='<?php if ($catlug_row) { echo $catlug_row['catlug_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var catlug_upd = '#frmCategorialugarUpd';
$(document).ready(function(e) {
	$(catlug_upd).find('#txtCatlugNombre').focus();
	$(catlug_upd).find('#btnActualizar').off('click').click(function(e) {
		if (catlug_validar()) {
			var catlug_id = '<?php echo $catlug_id; ?>';
			var catlug_nombre = $(catlug_upd).find('#txtCatlugNombre').val();
			var catlug_estado = $(catlug_upd).find('#txtCatlugEstado').val();

			$.post('categorialugar/proceso/categorialugar_update.php',{
				catlug_id : catlug_id,
				catlug_nombre : catlug_nombre,
				catlug_estado : catlug_estado
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
	$(catlug_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function catlug_validar() {
	var catlug_nombre = $(catlug_upd).find('#txtCatlugNombre').val();

	if (catlug_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de categoría de lugar', 'txtCatlugNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>