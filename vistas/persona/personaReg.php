<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('pers_reg', 'persona/persona.php');
?>
<form id='frmPersonaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar persona</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPersApPaterno'>Ap paterno:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersApPaterno' name='txtPersApPaterno' maxlength='30' placeholder='Ingrese ap paterno'/></td>
	</tr>
	<tr><td><label for='txtPersApMaterno'>Ap materno:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersApMaterno' name='txtPersApMaterno' maxlength='30' placeholder='Ingrese ap materno'/></td>
	</tr>
	<tr><td><label for='txtPersNombres'>Nombres:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersNombres' name='txtPersNombres' maxlength='30' placeholder='Ingrese nombres'/></td>
	</tr>
	<tr><td><label for='txtPersCorreo'>Correo:</label></td>
		<td><input type='text' class='form-control txt200' id='txtPersCorreo' name='txtPersCorreo' maxlength='50' placeholder='Ingrese correo'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
	<input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
	<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var pers_reg = '#frmPersonaReg';
$(document).ready(function(e) {
	$(pers_reg).find('#txtPersApPaterno').focus();
	$(pers_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (pers_validar()){
			var pers_ap_paterno = $(pers_reg).find('#txtPersApPaterno').val();
			var pers_ap_materno = $(pers_reg).find('#txtPersApMaterno').val();
			var pers_nombres = $(pers_reg).find('#txtPersNombres').val();
			var pers_correo = $(pers_reg).find('#txtPersCorreo').val();

			$.post('persona/proceso/persona_insert.php',{
				pers_ap_paterno : pers_ap_paterno,
				pers_ap_materno : pers_ap_materno,
				pers_nombres : pers_nombres,
				pers_correo : pers_correo
			},
			function(datos) {
				if (datos > 0) {
					alert('Registro correcto');
					volver();
				} else {
					alert('Error al registrar. ' + datos);
				}
			});
		}
	});
	$(pers_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function pers_validar() {
	var pers_ap_paterno = $(pers_reg).find('#txtPersApPaterno').val();
	var pers_ap_materno = $(pers_reg).find('#txtPersApMaterno').val();
	var pers_nombres = $(pers_reg).find('#txtPersNombres').val();
	var pers_correo = $(pers_reg).find('#txtPersCorreo').val();

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