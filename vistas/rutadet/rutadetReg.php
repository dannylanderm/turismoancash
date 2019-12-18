<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('rutad_reg', 'rutadet/rutadet.php');
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<?php
	include_once '../../includes/rutaDAL.php';
	$ruta_dal = new rutaDAL();
?>
<form id='frmRutadetReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar detalle de ruta</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtRutadRutaID'>Ruta:</label></td>
		<td><select class='form-control txt250'  id='txtRutadRutaID' name='txtRutadRutaID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ruta_list = $ruta_dal->listarcbo(); ?>
			<?php foreach($ruta_list as $row) { ?>
				<option value='<?php echo $row['ruta_id']; ?>'>
					<?php echo $row['ruta_descripcion'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtRutadLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt250'  id='txtRutadLugID' name='txtRutadLugID'> <!-- maxlength='10' -->
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
	<tr><td><label for='txtRutadNroOrd'>Nro ord:</label></td>
		<td><input type='text' class='form-control txt250' id='txtRutadNroOrd' name='txtRutadNroOrd' maxlength='10' placeholder='Ingrese nro ord'/></td>
	</tr>
	<tr><td><label for='txtRutadDistancia'>Distancia:</label></td>
		<td><input type='text' class='form-control txt250' id='txtRutadDistancia' name='txtRutadDistancia' maxlength='11' placeholder='Ingrese distancia'/></td>
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
var rutad_reg = '#frmRutadetReg';
$(document).ready(function(e) {
	$(rutad_reg).find('#txtRutadRutaID').focus();
	$(rutad_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (rutad_validar()){
			var rutad_ruta_id = $(rutad_reg).find('#txtRutadRutaID').val();
			var rutad_lug_id = $(rutad_reg).find('#txtRutadLugID').val();
			var rutad_nro_ord = $(rutad_reg).find('#txtRutadNroOrd').val();
			var rutad_distancia = $(rutad_reg).find('#txtRutadDistancia').val();

			$.post('rutadet/proceso/rutadet_insert.php',{
				rutad_ruta_id : rutad_ruta_id,
				rutad_lug_id : rutad_lug_id,
				rutad_nro_ord : rutad_nro_ord,
				rutad_distancia : rutad_distancia
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
	$(rutad_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function rutad_validar() {
	var rutad_ruta_id = $(rutad_reg).find('#txtRutadRutaID').val();
	var rutad_lug_id = $(rutad_reg).find('#txtRutadLugID').val();
	var rutad_nro_ord = $(rutad_reg).find('#txtRutadNroOrd').val();
	var rutad_distancia = $(rutad_reg).find('#txtRutadDistancia').val();

	if (!(isInteger(rutad_ruta_id) && rutad_ruta_id > 0)) {
		alert('Seleccione ruta');
		return false;
	}
	if (!(isInteger(rutad_lug_id) && rutad_lug_id > 0)) {
		alert('Seleccione lugar turístico');
		return false;
	}
	if (!isInteger(rutad_nro_ord)) {
		alert('Ingrese nro ord válido');
		return false;
	}
	if (!isNumeric(rutad_distancia)) {
		alert('Ingrese distancia válido');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>