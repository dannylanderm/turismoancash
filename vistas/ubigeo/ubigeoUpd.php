<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('ubig_upd', 'ubigeo/ubigeo.php');
?>
<?php
	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
	$ubig_id = GetNumericParam('ubig_id');

	$ubig_row = $ubig_dal->getByID($ubig_id);
?>
<form id='frmUbigeoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar ubigeo</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUbigCodigo'>Codigo:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigCodigo' name='txtUbigCodigo' value='<?php if ($ubig_row) { echo htmlspecialchars($ubig_row['ubig_codigo']); } ?>' maxlength='6' placeholder='Ingrese codigo'/></td>
	</tr>
	<tr><td><label for='txtUbigDptoCod'>Dpto cod:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigDptoCod' name='txtUbigDptoCod' value='<?php if ($ubig_row) { echo $ubig_row['ubig_dpto_cod']; } ?>' maxlength='10' placeholder='Ingrese dpto cod'/></td>
	</tr>
	<tr><td><label for='txtUbigProvCod'>Prov cod:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigProvCod' name='txtUbigProvCod' value='<?php if ($ubig_row) { echo $ubig_row['ubig_prov_cod']; } ?>' maxlength='10' placeholder='Ingrese prov cod'/></td>
	</tr>
	<tr><td><label for='txtUbigDistCod'>Dist cod:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigDistCod' name='txtUbigDistCod' value='<?php if ($ubig_row) { echo $ubig_row['ubig_dist_cod']; } ?>' maxlength='10' placeholder='Ingrese dist cod'/></td>
	</tr>
	<tr><td><label for='txtUbigNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigNombre' name='txtUbigNombre' value='<?php if ($ubig_row) { echo htmlspecialchars($ubig_row['ubig_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtUbigEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigEstado' name='txtUbigEstado' value='<?php if ($ubig_row) { echo $ubig_row['ubig_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var ubig_upd = '#frmUbigeoUpd';
$(document).ready(function(e) {
	$(ubig_upd).find('#txtUbigCodigo').focus();
	$(ubig_upd).find('#btnActualizar').off('click').click(function(e) {
		if (ubig_validar()) {
			var ubig_id = '<?php echo $ubig_id; ?>';
			var ubig_codigo = $(ubig_upd).find('#txtUbigCodigo').val();
			var ubig_dpto_cod = $(ubig_upd).find('#txtUbigDptoCod').val();
			var ubig_prov_cod = $(ubig_upd).find('#txtUbigProvCod').val();
			var ubig_dist_cod = $(ubig_upd).find('#txtUbigDistCod').val();
			var ubig_nombre = $(ubig_upd).find('#txtUbigNombre').val();
			var ubig_estado = $(ubig_upd).find('#txtUbigEstado').val();

			$.post('ubigeo/proceso/ubigeo_update.php',{
				ubig_id : ubig_id,
				ubig_codigo : ubig_codigo,
				ubig_dpto_cod : ubig_dpto_cod,
				ubig_prov_cod : ubig_prov_cod,
				ubig_dist_cod : ubig_dist_cod,
				ubig_nombre : ubig_nombre,
				ubig_estado : ubig_estado
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
	$(ubig_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function ubig_validar() {
	var ubig_codigo = $(ubig_upd).find('#txtUbigCodigo').val();
	var ubig_dpto_cod = $(ubig_upd).find('#txtUbigDptoCod').val();
	var ubig_prov_cod = $(ubig_upd).find('#txtUbigProvCod').val();
	var ubig_dist_cod = $(ubig_upd).find('#txtUbigDistCod').val();
	var ubig_nombre = $(ubig_upd).find('#txtUbigNombre').val();

	if (ubig_codigo == '') {
		alert('Ingrese codigo');
		return false;
	}
	if (!isInteger(ubig_dpto_cod)) {
		alert('Ingrese dpto cod válido');
		return false;
	}
	if (!isInteger(ubig_prov_cod)) {
		alert('Ingrese prov cod válido');
		return false;
	}
	if (!isInteger(ubig_dist_cod)) {
		alert('Ingrese dist cod válido');
		return false;
	}
	if (ubig_nombre == '') {
		alert('Ingrese una nombre válida de ubigeo');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>