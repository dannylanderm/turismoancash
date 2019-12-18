<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	$parent = ReceiveParent('obj_upd', 'objetoturistico/objetoturistico.php');

	include_once '../../includes/objetoturisticoDAL.php';
	$obj_dal = new objetoturisticoDAL();
	$obj_id = GetNumericParam('obj_id');

	$obj_row = $obj_dal->getByID($obj_id);

	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();

	include_once '../../includes/tipoobjetoturisticoDAL.php';
	$tipoobj_dal = new tipoobjetoturisticoDAL();
?>
<form id='frmObjetoturisticoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar objeto turístico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtObjNombre'>Nombre:</label></td>
		<td><input type='text' class='form-control txt200' id='txtObjNombre' name='txtObjNombre' value='<?php if ($obj_row) { echo htmlspecialchars($obj_row['obj_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtObjTipoobjID'>Tipo de objeto turístico:</label></td>
		<td><select class='form-control txt200' id='txtObjTipoobjID' name='txtObjTipoobjID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tipoobj_list = $tipoobj_dal->listarcbo($obj_row['obj_tipoobj_id']);  foreach($tipoobj_list as $row) { ?>
				<option value='<?php echo $row['tipoobj_id']; ?>'
					<?php echo ($row['tipoobj_id'] == $obj_row['tipoobj_id']) ? 'selected' : '';  ?>>
					<?php echo $row['tipoobj_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtObjFoto'>Foto:</label></td>
		<td><input type='text' class='form-control txt200' id='txtObjFoto' name='txtObjFoto' value='<?php if ($obj_row) { echo htmlspecialchars($obj_row['obj_foto']); } ?>' maxlength='256' placeholder='Ingrese foto'/></td>
	</tr>
	<tr><td><label for='txtObjComentario'>Comentario:</label></td>
		<td><input type='text' class='form-control txt200' id='txtObjComentario' name='txtObjComentario' value='<?php if ($obj_row) { echo htmlspecialchars($obj_row['obj_comentario']); } ?>' maxlength='500' placeholder='Ingrese comentario'/></td>
	</tr>
	<tr><td><label for='txtObjFechaDatacion'>Fecha datacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtObjFechaDatacion' name='txtObjFechaDatacion' value='<?php if ($obj_row) { echo formatDate($obj_row['obj_fecha_datacion']); } ?>'  placeholder='Ingrese fecha datacion'/></td>
	</tr>
	<tr><td><label for='txtObjLugID'>Lugar turístico:</label></td>
		<td><select class='form-control txt200' id='txtObjLugID' name='txtObjLugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo($obj_row['obj_lug_id']);  foreach($lug_list as $row) { ?>
				<option value='<?php echo $row['lug_id']; ?>'
					<?php echo ($row['lug_id'] == $obj_row['lug_id']) ? 'selected' : '';  ?>>
					<?php echo $row['lug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtObjSituacion'>Situacion:</label></td>
		<td><input type='text' class='form-control txt200' id='txtObjSituacion' name='txtObjSituacion' value='<?php if ($obj_row) { echo $obj_row['obj_situacion']; } ?>'  placeholder='Ingrese situacion'/></td>
	</tr>
	<tr hidden><td><label for='txtObjEstado'>Estado:</label></td>
		<td><input type='text' class='form-control txt200' id='txtObjEstado' name='txtObjEstado' value='<?php if ($obj_row) { echo $obj_row['obj_estado']; } ?>'  placeholder='Ingrese estado'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
		<input class='btn b_naranja' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
		<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var obj_upd = '#frmObjetoturisticoUpd';
$(document).ready(function(e) {
	$(obj_upd).find('#txtObjNombre').focus();
	$(obj_upd).find('#btnActualizar').off('click').click(function(e) {
		if (obj_validar()) {
			var obj_id = '<?php echo $obj_id; ?>';
			var obj_nombre = $(obj_upd).find('#txtObjNombre').val();
			var obj_tipoobj_id = $(obj_upd).find('#txtObjTipoobjID').val();
			var obj_foto = $(obj_upd).find('#txtObjFoto').val();
			var obj_comentario = $(obj_upd).find('#txtObjComentario').val();
			var obj_fecha_datacion = getDateYMD($(obj_upd).find('#txtObjFechaDatacion').val());
			var obj_lug_id = $(obj_upd).find('#txtObjLugID').val();
			var obj_situacion = $(obj_upd).find('#txtObjSituacion').val();
			var obj_estado = $(obj_upd).find('#txtObjEstado').val();

			$.post('objetoturistico/proceso/objetoturistico_update.php',{
				obj_id : obj_id,
				obj_nombre : obj_nombre,
				obj_tipoobj_id : obj_tipoobj_id,
				obj_foto : obj_foto,
				obj_comentario : obj_comentario,
				obj_fecha_datacion : obj_fecha_datacion,
				obj_lug_id : obj_lug_id,
				obj_situacion : obj_situacion,
				obj_estado : obj_estado
			},
			function(datos) {
				if (datos == 1){
					alert('Actualizacion correcta');
					volver();
				} else {
					alert('Error al actualizar. ' + datos);
				}
			});
		}
	});
	$(obj_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function obj_validar() {
	var obj_nombre = $(obj_upd).find('#txtObjNombre').val();
	var obj_tipoobj_id = $(obj_upd).find('#txtObjTipoobjID').val();
	var obj_foto = $(obj_upd).find('#txtObjFoto').val();
	var obj_comentario = $(obj_upd).find('#txtObjComentario').val();
	var obj_fecha_datacion = $(obj_upd).find('#txtObjFechaDatacion').val();
	var obj_lug_id = $(obj_upd).find('#txtObjLugID').val();
	var obj_situacion = $(obj_upd).find('#txtObjSituacion').val();

	if (obj_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de objeto turístico', 'txtObjNombre');
		return false;
	}
	if (!(isInteger(obj_tipoobj_id) && obj_tipoobj_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de objeto turístico</b>', 'txtObjTipoobjID');
		return false;
	}
	if (obj_foto == '') {
		showMessageWarning('Ingrese una <b>foto</b> válida', 'txtObjFoto');
		return false;
	}
	if (obj_comentario == '') {
		showMessageWarning('Ingrese una <b>comentario</b> válida', 'txtObjComentario');
		return false;
	}
	if (!isDate(obj_fecha_datacion)) {
		showMessageWarning('Ingrese una <b>fecha datacion</b> válida', 'txtObjFechaDatacion');
		return false;
	}
	if (!(isInteger(obj_lug_id) && obj_lug_id > 0)) {
		showMessageWarning('Seleccione <b>lugar turístico</b>', 'txtObjLugID');
		return false;
	}
	if (!isTinyint(obj_situacion)) {
		showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtObjSituacion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>