<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('catlug_reg', 'categorialugar/categorialugar.php');
?>
<form id='frmCategorialugarReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar categoría de lugar</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCatlugNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCatlugNombre' name='txtCatlugNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var catlug_reg = '#frmCategorialugarReg';
$(document).ready(function(e) {
	$(catlug_reg).find('#txtCatlugNombre').focus();
	$(catlug_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (catlug_validar()){
			var catlug_nombre = $(catlug_reg).find('#txtCatlugNombre').val();

			$.post('categorialugar/proceso/categorialugar_insert.php',{
				catlug_nombre : catlug_nombre
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
	$(catlug_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function catlug_validar() {
	var catlug_nombre = $(catlug_reg).find('#txtCatlugNombre').val();

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