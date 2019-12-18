<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('pers_upd', 'persona/persona.php');

	include_once '../../includes/personaDAL.php';
	$pers_dal = new personaDAL();
	$pers_id = GetNumericParam('pers_id');

	$pers_row = $pers_dal->getByID($pers_id);
?>
<form id='frmPersonaUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar persona</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPersApPaterno'>Ap paterno:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersApPaterno' name='txtPersApPaterno' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_ap_paterno']); } ?>' maxlength='30' placeholder='Ingrese ap paterno'/></td>
	</tr>
	<tr><td><label for='txtPersApMaterno'>Ap materno:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersApMaterno' name='txtPersApMaterno' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_ap_materno']); } ?>' maxlength='30' placeholder='Ingrese ap materno'/></td>
	</tr>
	<tr><td><label for='txtPersNombres'>Nombres:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersNombres' name='txtPersNombres' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_nombres']); } ?>' maxlength='30' placeholder='Ingrese nombres'/></td>
	</tr>
	<tr><td><label for='txtPersCorreo'>Correo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersCorreo' name='txtPersCorreo' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_correo']); } ?>' maxlength='50' placeholder='Ingrese correo'/></td>
	</tr>
	<tr hidden><td><label for='txtPersEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersEstado' name='txtPersEstado' value='<?php if ($pers_row) { echo $pers_row['pers_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var pers_upd = '#frmPersonaUpd';
$(document).ready(function(e) {
	$(pers_upd).find('#txtPersApPaterno').focus();
	$(pers_upd).find('#btnActualizar').off('click').click(function(e) {
		if (pers_validar()) {
			var pers_id = '<?php echo $pers_id; ?>';
			var pers_ap_paterno = $(pers_upd).find('#txtPersApPaterno').val();
			var pers_ap_materno = $(pers_upd).find('#txtPersApMaterno').val();
			var pers_nombres = $(pers_upd).find('#txtPersNombres').val();
			var pers_correo = $(pers_upd).find('#txtPersCorreo').val();
			var pers_estado = $(pers_upd).find('#txtPersEstado').val();

			$.post('persona/proceso/persona_update.php',{
				pers_id : pers_id,
				pers_ap_paterno : pers_ap_paterno,
				pers_ap_materno : pers_ap_materno,
				pers_nombres : pers_nombres,
				pers_correo : pers_correo,
				pers_estado : pers_estado
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
	$(pers_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function pers_validar() {
	var pers_ap_paterno = $(pers_upd).find('#txtPersApPaterno').val();
	var pers_ap_materno = $(pers_upd).find('#txtPersApMaterno').val();
	var pers_nombres = $(pers_upd).find('#txtPersNombres').val();
	var pers_correo = $(pers_upd).find('#txtPersCorreo').val();

	if (pers_ap_paterno == '') {
		showMessageWarning('Ingrese una <b>ap paterno</b> válida', 'txtPersApPaterno');
		return false;
	}
	if (pers_ap_materno == '') {
		showMessageWarning('Ingrese una <b>ap materno</b> válida', 'txtPersApMaterno');
		return false;
	}
	if (pers_nombres == '') {
		showMessageWarning('Ingrese una <b>nombres</b> válida de persona', 'txtPersNombres');
		return false;
	}
	if (!isEmail(pers_correo)) {
		showMessageWarning('Ingrese valor de <b>correo</b> válido', 'txtPersCorreo');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>