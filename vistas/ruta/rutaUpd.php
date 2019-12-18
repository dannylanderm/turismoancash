<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('ruta_upd', 'ruta/ruta.php');

	include_once '../../includes/rutaDAL.php';
	$ruta_dal = new rutaDAL();
	$ruta_id = GetNumericParam('ruta_id');

	$ruta_row = $ruta_dal->getByID($ruta_id);
?>
<form id='frmRutaUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar ruta</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtRutaDescripcion'>Descripcion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtRutaDescripcion' name='txtRutaDescripcion' value='<?php if ($ruta_row) { echo htmlspecialchars($ruta_row['ruta_descripcion']); } ?>' maxlength='100' placeholder='Ingrese descripcion'/></td>
	</tr>
	<tr hidden><td><label for='txtRutaEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtRutaEstado' name='txtRutaEstado' value='<?php if ($ruta_row) { echo $ruta_row['ruta_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var ruta_upd = '#frmRutaUpd';
$(document).ready(function(e) {
	$(ruta_upd).find('#txtRutaDescripcion').focus();
	$(ruta_upd).find('#btnActualizar').off('click').click(function(e) {
		if (ruta_validar()) {
			var ruta_id = '<?php echo $ruta_id; ?>';
			var ruta_descripcion = $(ruta_upd).find('#txtRutaDescripcion').val();
			var ruta_estado = $(ruta_upd).find('#txtRutaEstado').val();

			$.post('ruta/proceso/ruta_update.php',{
				ruta_id : ruta_id,
				ruta_descripcion : ruta_descripcion,
				ruta_estado : ruta_estado
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
	$(ruta_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function ruta_validar() {
	var ruta_descripcion = $(ruta_upd).find('#txtRutaDescripcion').val();

	if (ruta_descripcion == '') {
		showMessageWarning('Ingrese una <b>descripcion</b> válida de ruta', 'txtRutaDescripcion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>