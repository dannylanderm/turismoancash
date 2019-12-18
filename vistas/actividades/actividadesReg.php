<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('activ_reg', 'actividades/actividades.php');

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();

	include_once '../../includes/tipoactividadDAL.php';
	$tipoactiv_dal = new tipoactividadDAL();
?>
<form id='frmActividadesReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar actividad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtActivLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtActivLugID' name='txtActivLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo();  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtActivTipoactivID'>Tipo de actividad:</label></td>
		<td><select class='form-control txt200' id='txtActivTipoactivID' name='txtActivTipoactivID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipoactiv_list = $tipoactiv_dal->listarcbo();  foreach($tipoactiv_list as $row) { ?>
				<option value='<?php echo $row['tipoactiv_id']; ?>'>
					<?php echo $row['tipoactiv_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtActivSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtActivSituacion' name='txtActivSituacion'  placeholder='Ingrese situacion'/></td>
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
var activ_reg = '#frmActividadesReg';
$(document).ready(function(e) {
	$(activ_reg).find('#txtActivLugID').focus();
	$(activ_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (activ_validar()){
			var activ_lug_id = $(activ_reg).find('#txtActivLugID').val();
			var activ_tipoactiv_id = $(activ_reg).find('#txtActivTipoactivID').val();
			var activ_situacion = $(activ_reg).find('#txtActivSituacion').val();

			$.post('actividades/proceso/actividades_insert.php',{
				activ_lug_id : activ_lug_id,
				activ_tipoactiv_id : activ_tipoactiv_id,
				activ_situacion : activ_situacion
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
	$(activ_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function activ_validar() {
	var activ_lug_id = $(activ_reg).find('#txtActivLugID').val();
	var activ_tipoactiv_id = $(activ_reg).find('#txtActivTipoactivID').val();
	var activ_situacion = $(activ_reg).find('#txtActivSituacion').val();

	if (!(isInteger(activ_lug_id) && activ_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtActivLugID');
		return false;
	}
	if (!(isInteger(activ_tipoactiv_id) && activ_tipoactiv_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de actividad</b>', 'txtActivTipoactivID');
		return false;
	}
	if (!isTinyint(activ_situacion)) {
		showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtActivSituacion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>