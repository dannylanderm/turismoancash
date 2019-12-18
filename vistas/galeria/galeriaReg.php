<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('gal_reg', 'galeria/galeria.php');
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<form id='frmGaleriaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar galería</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtGalLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt250'  id='txtGalLugID' name='txtGalLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo(); ?>
			<?php foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtGalFoto'>Foto:</label></td>
		<td><input type='text' class='form-control txt250' id='txtGalFoto' name='txtGalFoto' maxlength='256' placeholder='Ingrese foto'/></td>
	</tr>
	<tr><td><label for='txtGalFotoDescripcion'>Foto descripcion:</label></td>
		<td><input type='text' class='form-control txt250' id='txtGalFotoDescripcion' name='txtGalFotoDescripcion' maxlength='500' placeholder='Ingrese foto descripcion'/></td>
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
var gal_reg = '#frmGaleriaReg';
$(document).ready(function(e) {
	$(gal_reg).find('#txtGalLugID').focus();
	$(gal_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (gal_validar()){
			var gal_lug_id = $(gal_reg).find('#txtGalLugID').val();
			var gal_foto = $(gal_reg).find('#txtGalFoto').val();
			var gal_foto_descripcion = $(gal_reg).find('#txtGalFotoDescripcion').val();

			$.post('galeria/proceso/galeria_insert.php',{
				gal_lug_id : gal_lug_id,
				gal_foto : gal_foto,
				gal_foto_descripcion : gal_foto_descripcion
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
	$(gal_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function gal_validar() {
	var gal_lug_id = $(gal_reg).find('#txtGalLugID').val();
	var gal_foto = $(gal_reg).find('#txtGalFoto').val();
	var gal_foto_descripcion = $(gal_reg).find('#txtGalFotoDescripcion').val();

	if (!(isInteger(gal_lug_id) && gal_lug_id > 0)) {
		alert('Seleccione lugar turístico');
		return false;
	}
	if (gal_foto == '') {
		alert('Ingrese una foto válida');
		return false;
	}
	if (gal_foto_descripcion == '') {
		alert('Ingrese una foto descripcion válida de galería');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>