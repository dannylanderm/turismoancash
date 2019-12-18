<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('obj_reg', 'objetoturistico/objetoturistico.php');
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<?php
	include_once '../../includes/tipoobjetoturisticoDAL.php';
	$tipoobj_dal = new tipoobjetoturisticoDAL();
?>
<form id='frmObjetoturisticoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar objeto turístico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtObjNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt250' id='txtObjNombre' name='txtObjNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtObjTipoobjID'>Tipo de objeto turístico:</label></td>
		<td><select class='form-control txt250'  id='txtObjTipoobjID' name='txtObjTipoobjID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipoobj_list = $tipoobj_dal->listarcbo(); ?>
			<?php foreach($tipoobj_list as $row) { ?>
				<option value='<?php echo $row['tipoobj_id']; ?>'>
					<?php echo $row['tipoobj_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtObjFoto'>Foto:</label></td>
		<td><input type='text' class='form-control txt250' id='txtObjFoto' name='txtObjFoto' maxlength='256' placeholder='Ingrese foto'/></td>
	</tr>
	<tr><td><label for='txtObjComentario'>Comentario:</label></td>
		<td><input type='text' class='form-control txt250' id='txtObjComentario' name='txtObjComentario' maxlength='500' placeholder='Ingrese comentario'/></td>
	</tr>
	<tr><td><label for='txtObjFechaDatacion'>Fecha datacion:</label></td>
		<td><input type='text' class='form-control txt250' id='txtObjFechaDatacion' name='txtObjFechaDatacion'  placeholder='Ingrese fecha datacion'/></td>
	</tr>
	<tr><td><label for='txtObjLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt250'  id='txtObjLugID' name='txtObjLugID'> <!-- maxlength='10' -->
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
	<tr><td><label for='txtObjSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt250' id='txtObjSituacion' name='txtObjSituacion'  placeholder='Ingrese situacion'/></td>
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
var obj_reg = '#frmObjetoturisticoReg';
$(document).ready(function(e) {
	$(obj_reg).find('#txtObjNombre').focus();
	$(obj_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (obj_validar()){
			var obj_nombre = $(obj_reg).find('#txtObjNombre').val();
			var obj_tipoobj_id = $(obj_reg).find('#txtObjTipoobjID').val();
			var obj_foto = $(obj_reg).find('#txtObjFoto').val();
			var obj_comentario = $(obj_reg).find('#txtObjComentario').val();
			var obj_fecha_datacion = getDateYMD($(obj_reg).find('#txtObjFechaDatacion').val());
			var obj_lug_id = $(obj_reg).find('#txtObjLugID').val();
			var obj_situacion = $(obj_reg).find('#txtObjSituacion').val();

			$.post('objetoturistico/proceso/objetoturistico_insert.php',{
				obj_nombre : obj_nombre,
				obj_tipoobj_id : obj_tipoobj_id,
				obj_foto : obj_foto,
				obj_comentario : obj_comentario,
				obj_fecha_datacion : obj_fecha_datacion,
				obj_lug_id : obj_lug_id,
				obj_situacion : obj_situacion
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
	$(obj_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function obj_validar() {
	var obj_nombre = $(obj_reg).find('#txtObjNombre').val();
	var obj_tipoobj_id = $(obj_reg).find('#txtObjTipoobjID').val();
	var obj_foto = $(obj_reg).find('#txtObjFoto').val();
	var obj_comentario = $(obj_reg).find('#txtObjComentario').val();
	var obj_fecha_datacion = $(obj_reg).find('#txtObjFechaDatacion').val();
	var obj_lug_id = $(obj_reg).find('#txtObjLugID').val();
	var obj_situacion = $(obj_reg).find('#txtObjSituacion').val();

	if (obj_nombre == '') {
		alert('Ingrese una nombre válida de objeto turístico');
		return false;
	}
	if (!(isInteger(obj_tipoobj_id) && obj_tipoobj_id > 0)) {
		alert('Seleccione tipo de objeto turístico');
		return false;
	}
	if (obj_foto == '') {
		alert('Ingrese una foto válida');
		return false;
	}
	if (obj_comentario == '') {
		alert('Ingrese una comentario válida');
		return false;
	}
	if (!isDate(obj_fecha_datacion)) {
		alert('Ingrese una fecha datacion válida');
		return false;
	}
	if (!(isInteger(obj_lug_id) && obj_lug_id > 0)) {
		alert('Seleccione lugar turístico');
		return false;
	}
	if (!isTinyint(obj_situacion)) {
		alert('Ingrese un valor de situacion válido');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>