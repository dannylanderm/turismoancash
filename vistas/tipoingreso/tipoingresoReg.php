<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('tipoing_reg', 'tipoingreso/tipoingreso.php');
?>
<form id='frmTipoingresoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo de ingreso</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipoingNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtTipoingNombre' name='txtTipoingNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var tipoing_reg = '#frmTipoingresoReg';
$(document).ready(function(e) {
	$(tipoing_reg).find('#txtTipoingNombre').focus();
	$(tipoing_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tipoing_validar()){
			var tipoing_nombre = $(tipoing_reg).find('#txtTipoingNombre').val();

			$.post('tipoingreso/proceso/tipoingreso_insert.php',{
				tipoing_nombre : tipoing_nombre
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
	$(tipoing_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipoing_validar() {
	var tipoing_nombre = $(tipoing_reg).find('#txtTipoingNombre').val();

	if (tipoing_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo de ingreso', 'txtTipoingNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>