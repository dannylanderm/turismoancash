<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('obj_reg', 'objetoturistico/objetoturistico.php');
?>
<?php
	include_once '../../includes/objetoturisticoDAL.php';
	$obj_dal = new objetoturisticoDAL();
	$obj_id  = GetNumericParam('obj_id');
	
	$obj_row = $obj_dal->getByID($obj_id);
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
<div class='txt_center'>
<div class='inline txt_left' style='vertical-align: top;'>
<table class='form_data'>
<tr>
    <td><label for='txtObjLugID'>Lugar turístico:</label></td>
    <td><select class='form-control txt250' id='txtObjLugID' name='txtObjLugID'>
            <option value='0'>(Seleccione)</option>
			<?php $lug_list = $lug_dal->listarcbo($obj_row['obj_lug_id']); ?>
			<?php foreach ($lug_list as $row) { ?>
                <option value='<?php echo $row['lug_id']; ?>'
					<?php echo ($row['lug_id'] == $obj_row['lug_id']) ? 'selected' : ''; ?>>
					<?php echo $row['lug_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtObjNombre'>Nombre objeto:</label></td>
    <td><input type='text' class='form-control txt250' id='txtObjNombre' name='txtObjNombre'
               value='<?php if ($obj_row) {
		           echo htmlspecialchars($obj_row['obj_nombre']);
	           } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
</tr>
<tr>
    <td><label for='txtObjTipoobjID'>Tipo de objeto:</label></td>
    <td><select class='form-control txt250' id='txtObjTipoobjID' name='txtObjTipoobjID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $tipoobj_list = $tipoobj_dal->listarcbo($obj_row['obj_tipoobj_id']); ?>
			<?php foreach ($tipoobj_list as $row) { ?>
                <option value='<?php echo $row['tipoobj_id']; ?>'
					<?php echo ($row['tipoobj_id'] == $obj_row['tipoobj_id']) ? 'selected' : ''; ?>>
					<?php echo $row['tipoobj_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtObjComentario'>Comentario:</label></td>
    <td><textarea id='txtObjComentario' name='txtObjComentario' maxlength='500' cols='40' rows='5'
                  class='form-control' placeholder='Ingrese comentario'><?php if ($obj_row) {
				echo htmlspecialchars($obj_row['obj_comentario']);
			} ?></textarea>
    </td>
</tr>
<tr>
    <td><label for='txtObjFechaDatacion'>Fecha datación:</label></td>
    <td><input type='text' class='form-control txt250' id='txtObjFechaDatacion' name='txtObjFechaDatacion'
               value='<?php if ($obj_row) {
		           echo formatDate($obj_row['obj_fecha_datacion']);
	           } ?>' placeholder='00/00/0000'/></td>
</tr>
<tr hidden>
    <td><label for='txtObjSituacion'>Situacion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtObjSituacion' name='txtObjSituacion'
               value='<?php if ($obj_row) {
		           echo $obj_row['obj_situacion'];
	           } else {
		           echo 1;
	           } ?>' placeholder='Ingrese situacion'/></td>
</tr>
</table>
</div>
<div class='inline' style='vertical-align: top;'>
    <label for='txtObjFoto'>Foto:</label>
    <a href='#' id='btnQuitarObjFoto' class='btn btn-danger' style='float: right'>Quitar</a>
    <a href='#' id='btnAdjuntarObjFoto' class='btn btn-default' style='float: right'>Adjuntar</a>
    <input type='file' id='fileObjFoto' name='fileObjFoto' maxlength='255'
           class='hidden form-control txt250' placeholder='Ingrese logo' autocomplete='off'><br>

    <div class='rpad3'>
        <img id='imgObjFoto' style='width: 333px;' src='<?php if ($lug_row) {
			echo $lug_row['obj_foto'] ? '../objetos/'.htmlspecialchars($lug_row['obj_foto']) : '../resources/img/utils/img_80x120.png';
		} else {
			echo '../resources/img/utils/img_80x120.png';
		} ?>' class='w100p b_gris bglb_gris' alt=''>
    </div>
</div>
<hr class='separator'/>
<div class='form_foot'>
    <input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
    <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div>
</div>
</div>
</div>
</form>
<br/>
<script>
var obj_reg = '#frmObjetoturisticoReg';
$(document).ready(function (e) {
    $(obj_reg).find('#txtObjNombre').focus();
    $(obj_reg).find('#txtObjFechaDatacion').datepicker();

    $('#btnAdjuntarObjFoto').off('click').click(function () {
        $('#fileObjFoto').trigger('click');
    });

    var obj_foto_contenido_deleted = 0;
    $('#btnQuitarObjFoto').off('click').click(function () {
        obj_foto_contenido_deleted = 1;
        $('#fileObjFoto').val('');
        $('#imgObjFoto').attr('src', '../recursos/img/utils/img_80x120.png');
    });

    $('#fileObjFoto').change(function () {
        showImagePreview('#imgObjFoto', this);
    });

    $(obj_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (obj_validar()) {
            var obj_id             = '<?= $obj_id ?>';
            var obj_nombre         = $(obj_reg).find('#txtObjNombre').val();
            var obj_tipoobj_id     = $(obj_reg).find('#txtObjTipoobjID').val();
            var obj_foto           = $(obj_reg).find('#fileObjFoto').prop('files');
            var obj_comentario     = $(obj_reg).find('#txtObjComentario').val();
            var obj_fecha_datacion = getDateYMD($(obj_reg).find('#txtObjFechaDatacion').val());
            var obj_lug_id         = $(obj_reg).find('#txtObjLugID').val();
            var obj_situacion      = $(obj_reg).find('#txtObjSituacion').val();

            var form_data = new FormData();
            form_data.append('obj_id', obj_id);
            form_data.append('obj_nombre', obj_nombre);
            form_data.append('obj_tipoobj_id', obj_tipoobj_id);
            form_data.append('obj_foto', obj_foto ? obj_foto[0] : null);
            form_data.append('obj_foto_contenido_deleted', obj_foto_contenido_deleted);
            form_data.append('obj_comentario', obj_comentario);
            form_data.append('obj_fecha_datacion', obj_fecha_datacion);
            form_data.append('obj_lug_id', obj_lug_id);
            form_data.append('obj_situacion', obj_situacion);

            $.ajax({
                url        : 'objetoturistico/proceso/' + (toInteger(obj_id) === 0 ? 'objetoturistico_insert.php' : 'objetoturistico_update.php'),
                type       : 'POST',
                contentType: false,
                data       : form_data,
                processData: false,
                success    : function (datos) {
                    if (datos > 0) {
                        alert('Guardado correcto');
                        volver();
                    } else {
                        alert('Error al guardar. ' + datos);
                    }
                },
                error      : function (datos) {
                    alert('Error al guardar. ' + datos);
                }
            });
        }
    });
    $(obj_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function obj_validar() {
    var obj_nombre         = $(obj_reg).find('#txtObjNombre').val();
    var obj_tipoobj_id     = $(obj_reg).find('#txtObjTipoobjID').val();
    var obj_foto           = $(obj_reg).find('#txtObjFoto').val();
    var obj_comentario     = $(obj_reg).find('#txtObjComentario').val();
    var obj_fecha_datacion = $(obj_reg).find('#txtObjFechaDatacion').val();
    var obj_lug_id         = $(obj_reg).find('#txtObjLugID').val();
    var obj_situacion      = $(obj_reg).find('#txtObjSituacion').val();

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
