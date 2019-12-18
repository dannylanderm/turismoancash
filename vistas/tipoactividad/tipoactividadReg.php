<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('tipoactiv_reg', 'tipoactividad/tipoactividad.php');
?>
<form id='frmTipoactividadReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo de actividad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipoactivNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtTipoactivNombre' name='txtTipoactivNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var tipoactiv_reg = '#frmTipoactividadReg';
$(document).ready(function(e) {
	$(tipoactiv_reg).find('#txtTipoactivNombre').focus();
	$(tipoactiv_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tipoactiv_validar()){
			var tipoactiv_nombre = $(tipoactiv_reg).find('#txtTipoactivNombre').val();

			$.post('tipoactividad/proceso/tipoactividad_insert.php',{
				tipoactiv_nombre : tipoactiv_nombre
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
	$(tipoactiv_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipoactiv_validar() {
	var tipoactiv_nombre = $(tipoactiv_reg).find('#txtTipoactivNombre').val();

	if (tipoactiv_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo de actividad', 'txtTipoactivNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>