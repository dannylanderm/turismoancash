<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tipositio_reg', 'tipositio/tipositio.php');
?>
<form id='frmTipositioReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo de sitio</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipositioNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtTipositioNombre' name='txtTipositioNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var tipositio_reg = '#frmTipositioReg';
$(document).ready(function(e) {
	$(tipositio_reg).find('#txtTipositioNombre').focus();
	$(tipositio_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tipositio_validar()){
			var tipositio_nombre = $(tipositio_reg).find('#txtTipositioNombre').val();

			$.post('tipositio/proceso/tipositio_insert.php',{
				tipositio_nombre : tipositio_nombre
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
	$(tipositio_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipositio_validar() {
	var tipositio_nombre = $(tipositio_reg).find('#txtTipositioNombre').val();

	if (tipositio_nombre == '') {
		alert('Ingrese una nombre válida de tipo de sitio');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>