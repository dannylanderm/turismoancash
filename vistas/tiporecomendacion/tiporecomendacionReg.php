<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tiporec_reg', 'tiporecomendacion/tiporecomendacion.php');
?>
<form id='frmTiporecomendacionReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo de recomendación</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTiporecNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTiporecNombre' name='txtTiporecNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var tiporec_reg = '#frmTiporecomendacionReg';
$(document).ready(function(e) {
	$(tiporec_reg).find('#txtTiporecNombre').focus();
	$(tiporec_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tiporec_validar()){
			var tiporec_nombre = $(tiporec_reg).find('#txtTiporecNombre').val();

			$.post('tiporecomendacion/proceso/tiporecomendacion_insert.php',{
				tiporec_nombre : tiporec_nombre
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
	$(tiporec_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tiporec_validar() {
	var tiporec_nombre = $(tiporec_reg).find('#txtTiporecNombre').val();

	if (tiporec_nombre == '') {
		alert('Ingrese una nombre válida de tipo de recomendación');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>