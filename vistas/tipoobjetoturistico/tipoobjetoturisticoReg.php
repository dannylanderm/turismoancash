<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('tipoobj_reg', 'tipoobjetoturistico/tipoobjetoturistico.php');
?>
<form id='frmTipoobjetoturisticoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo de objeto turístico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipoobjNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtTipoobjNombre' name='txtTipoobjNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var tipoobj_reg = '#frmTipoobjetoturisticoReg';
$(document).ready(function(e) {
	$(tipoobj_reg).find('#txtTipoobjNombre').focus();
	$(tipoobj_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tipoobj_validar()){
			var tipoobj_nombre = $(tipoobj_reg).find('#txtTipoobjNombre').val();

			$.post('tipoobjetoturistico/proceso/tipoobjetoturistico_insert.php',{
				tipoobj_nombre : tipoobj_nombre
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
	$(tipoobj_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipoobj_validar() {
	var tipoobj_nombre = $(tipoobj_reg).find('#txtTipoobjNombre').val();

	if (tipoobj_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo de objeto turístico', 'txtTipoobjNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>