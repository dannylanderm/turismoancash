<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('ubig_reg', 'ubigeo/ubigeo.php');
?>
<form id='frmUbigeoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar ubigeo</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUbigCodigo'>Codigo:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigCodigo' name='txtUbigCodigo' maxlength='6' placeholder='Ingrese codigo'/></td>
	</tr>
	<tr><td><label for='txtUbigDptoCod'>Dpto cod:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigDptoCod' name='txtUbigDptoCod' maxlength='10' placeholder='Ingrese dpto cod'/></td>
	</tr>
	<tr><td><label for='txtUbigProvCod'>Prov cod:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigProvCod' name='txtUbigProvCod' maxlength='10' placeholder='Ingrese prov cod'/></td>
	</tr>
	<tr><td><label for='txtUbigDistCod'>Dist cod:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigDistCod' name='txtUbigDistCod' maxlength='10' placeholder='Ingrese dist cod'/></td>
	</tr>
	<tr><td><label for='txtUbigNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtUbigNombre' name='txtUbigNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var ubig_reg = '#frmUbigeoReg';
$(document).ready(function(e) {
	$(ubig_reg).find('#txtUbigCodigo').focus();
	$(ubig_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (ubig_validar()){
			var ubig_codigo = $(ubig_reg).find('#txtUbigCodigo').val();
			var ubig_dpto_cod = $(ubig_reg).find('#txtUbigDptoCod').val();
			var ubig_prov_cod = $(ubig_reg).find('#txtUbigProvCod').val();
			var ubig_dist_cod = $(ubig_reg).find('#txtUbigDistCod').val();
			var ubig_nombre = $(ubig_reg).find('#txtUbigNombre').val();

			$.post('ubigeo/proceso/ubigeo_insert.php',{
				ubig_codigo : ubig_codigo,
				ubig_dpto_cod : ubig_dpto_cod,
				ubig_prov_cod : ubig_prov_cod,
				ubig_dist_cod : ubig_dist_cod,
				ubig_nombre : ubig_nombre
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
	$(ubig_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function ubig_validar() {
	var ubig_codigo = $(ubig_reg).find('#txtUbigCodigo').val();
	var ubig_dpto_cod = $(ubig_reg).find('#txtUbigDptoCod').val();
	var ubig_prov_cod = $(ubig_reg).find('#txtUbigProvCod').val();
	var ubig_dist_cod = $(ubig_reg).find('#txtUbigDistCod').val();
	var ubig_nombre = $(ubig_reg).find('#txtUbigNombre').val();

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