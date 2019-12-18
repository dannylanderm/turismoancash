<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('cerca_reg', 'cercania/cercania.php');

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();

	include_once '../../includes/sitioDAL.php';
	$sitio_dal = new sitioDAL();
?>
<form id='frmCercaniaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar cercanía</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCercaLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtCercaLugID' name='txtCercaLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo();  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtCercaSitioID'>Sitio:</label></td>
		<td><select class='form-control txt200' id='txtCercaSitioID' name='txtCercaSitioID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $sitio_list = $sitio_dal->listarcbo();  foreach($sitio_list as $row) { ?>
				<option value='<?php echo $row['sitio_id']; ?>'>
					<?php echo $row['sitio_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtCercaDistancia'>Distancia:</label></td>
		<td><input type='text' class='form-control txt200' id='txtCercaDistancia' name='txtCercaDistancia' maxlength='11' placeholder='Ingrese distancia'/></td>
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
var cerca_reg = '#frmCercaniaReg';
$(document).ready(function(e) {
	$(cerca_reg).find('#txtCercaLugID').focus();
	$(cerca_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (cerca_validar()){
			var cerca_lug_id = $(cerca_reg).find('#txtCercaLugID').val();
			var cerca_sitio_id = $(cerca_reg).find('#txtCercaSitioID').val();
			var cerca_distancia = $(cerca_reg).find('#txtCercaDistancia').val();

			$.post('cercania/proceso/cercania_insert.php',{
				cerca_lug_id : cerca_lug_id,
				cerca_sitio_id : cerca_sitio_id,
				cerca_distancia : cerca_distancia
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
	$(cerca_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function cerca_validar() {
	var cerca_lug_id = $(cerca_reg).find('#txtCercaLugID').val();
	var cerca_sitio_id = $(cerca_reg).find('#txtCercaSitioID').val();
	var cerca_distancia = $(cerca_reg).find('#txtCercaDistancia').val();

	if (!(isInteger(cerca_lug_id) && cerca_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtCercaLugID');
		return false;
	}
	if (!(isInteger(cerca_sitio_id) && cerca_sitio_id > 0)) {
		showMessageWarning('Seleccione <b>sitio</b>', 'txtCercaSitioID');
		return false;
	}
	if (!isNumeric(cerca_distancia)) {
		showMessageWarning('Ingrese <b>distancia</b> válido', 'txtCercaDistancia');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>