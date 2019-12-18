<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tipoobj_upd', 'tipoobjetoturistico/tipoobjetoturistico.php');
?>
<?php
	include_once '../../includes/tipoobjetoturisticoDAL.php';
	$tipoobj_dal = new tipoobjetoturisticoDAL();
	$tipoobj_id = GetNumericParam('tipoobj_id');

	$tipoobj_row = $tipoobj_dal->getByID($tipoobj_id);
?>
<form id='frmTipoobjetoturisticoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar tipo de objeto turístico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipoobjNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTipoobjNombre' name='txtTipoobjNombre' value='<?php if ($tipoobj_row) { echo htmlspecialchars($tipoobj_row['tipoobj_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtTipoobjEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTipoobjEstado' name='txtTipoobjEstado' value='<?php if ($tipoobj_row) { echo $tipoobj_row['tipoobj_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var tipoobj_upd = '#frmTipoobjetoturisticoUpd';
$(document).ready(function(e) {
	$(tipoobj_upd).find('#txtTipoobjNombre').focus();
	$(tipoobj_upd).find('#btnActualizar').off('click').click(function(e) {
		if (tipoobj_validar()) {
			var tipoobj_id = '<?php echo $tipoobj_id; ?>';
			var tipoobj_nombre = $(tipoobj_upd).find('#txtTipoobjNombre').val();
			var tipoobj_estado = $(tipoobj_upd).find('#txtTipoobjEstado').val();

			$.post('tipoobjetoturistico/proceso/tipoobjetoturistico_update.php',{
				tipoobj_id : tipoobj_id,
				tipoobj_nombre : tipoobj_nombre,
				tipoobj_estado : tipoobj_estado
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
	$(tipoobj_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipoobj_validar() {
	var tipoobj_nombre = $(tipoobj_upd).find('#txtTipoobjNombre').val();

	if (tipoobj_nombre == '') {
		alert('Ingrese una nombre válida de tipo de objeto turístico');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>