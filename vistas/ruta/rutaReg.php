<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('ruta_reg', 'ruta/ruta.php');
?>
<form id='frmRutaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar ruta</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtRutaDescripcion'>Descripcion:</label></td>
		<td><input type='text' class='form-control txt250' id='txtRutaDescripcion' name='txtRutaDescripcion' maxlength='100' placeholder='Ingrese descripcion'/></td>
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
var ruta_reg = '#frmRutaReg';
$(document).ready(function(e) {
	$(ruta_reg).find('#txtRutaDescripcion').focus();
	$(ruta_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (ruta_validar()){
			var ruta_descripcion = $(ruta_reg).find('#txtRutaDescripcion').val();

			$.post('ruta/proceso/ruta_insert.php',{
				ruta_descripcion : ruta_descripcion
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
	$(ruta_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function ruta_validar() {
	var ruta_descripcion = $(ruta_reg).find('#txtRutaDescripcion').val();

	if (ruta_descripcion == '') {
		alert('Ingrese una descripcion válida de ruta');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>