<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('lug_upd', 'lugarturistico/lugarturistico.php');
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
	$lug_id  = GetNumericParam('lug_id');
	
	$lug_row = $lug_dal->getByID($lug_id);
?>
<?php
	include_once '../../includes/tipoingresoDAL.php';
	$tipoing_dal = new tipoingresoDAL();
?>
<?php
	include_once '../../includes/tipolugarDAL.php';
	$tipolug_dal = new tipolugarDAL();
?>
<?php
	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmLugarturisticoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Editar lugar turístico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr>
    <td><label for='txtLugNombre'>Nombre:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugNombre' name='txtLugNombre'
               value='<?php if ($lug_row) {
		           echo htmlspecialchars($lug_row['lug_nombre']);
	           } ?>' maxlength='100' placeholder='Ingrese nombre'/></td>
</tr>
<tr>
    <td><label for='txtLugTipolugID'>Tipo de lugar:</label></td>
    <td><select class='form-control txt250' id='txtLugTipolugID' name='txtLugTipolugID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $tipolug_list = $tipolug_dal->listarcbo($lug_row['lug_tipolug_id']); ?>
			<?php foreach ($tipolug_list as $row) { ?>
                <option value='<?php echo $row['tipolug_id']; ?>'
					<?php echo ($row['tipolug_id'] == $lug_row['tipolug_id']) ? 'selected' : ''; ?>>
					<?php echo $row['tipolug_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtLugLatitudGeo'>Latitud geo:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugLatitudGeo' name='txtLugLatitudGeo'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_latitud_geo'];
	           } ?>' maxlength='16' placeholder='Ingrese latitud geo'/></td>
</tr>
<tr>
    <td><label for='txtLugLongitudGeo'>Longitud geo:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugLongitudGeo' name='txtLugLongitudGeo'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_longitud_geo'];
	           } ?>' maxlength='16' placeholder='Ingrese longitud geo'/></td>
</tr>
<tr>
    <td><label for='txtLugAltitud'>Altitud:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugAltitud' name='txtLugAltitud'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_altitud'];
	           } ?>' maxlength='9' placeholder='Ingrese altitud'/></td>
</tr>
<tr>
    <td><label for='txtLugTamanioArea'>Tamanio area:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugTamanioArea' name='txtLugTamanioArea'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_tamanio_area'];
	           } ?>' maxlength='9' placeholder='Ingrese tamanio area'/></td>
</tr>
<tr>
    <td><label for='txtLugFoto'>Foto:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugFoto' name='txtLugFoto' value='<?php if ($lug_row) {
			echo htmlspecialchars($lug_row['lug_foto']);
		} ?>' maxlength='256' placeholder='Ingrese foto'/></td>
</tr>
<tr>
    <td><label for='txtLugDescripcion'>Descripcion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugDescripcion' name='txtLugDescripcion'
               value='<?php if ($lug_row) {
		           echo htmlspecialchars($lug_row['lug_descripcion']);
	           } ?>' maxlength='400' placeholder='Ingrese descripcion'/></td>
</tr>
<tr>
    <td><label for='txtLugUbigID'>Ubigeo:</label></td>
    <td><select class='form-control txt250' id='txtLugUbigID' name='txtLugUbigID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo($lug_row['lug_ubig_id']); ?>
			<?php foreach ($ubig_list as $row) { ?>
                <option value='<?php echo $row['ubig_id']; ?>'
					<?php echo ($row['ubig_id'] == $lug_row['ubig_id']) ? 'selected' : ''; ?>>
					<?php echo $row['ubig_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtLugDireccionRef'>Direccion ref:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugDireccionRef' name='txtLugDireccionRef'
               value='<?php if ($lug_row) {
		           echo htmlspecialchars($lug_row['lug_direccion_ref']);
	           } ?>' maxlength='100' placeholder='Ingrese direccion ref'/></td>
</tr>
<tr>
    <td><label for='txtLugTipoingID'>Tipo de ingreso:</label></td>
    <td><select class='form-control txt250' id='txtLugTipoingID' name='txtLugTipoingID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $tipoing_list = $tipoing_dal->listarcbo($lug_row['lug_tipoing_id']); ?>
			<?php foreach ($tipoing_list as $row) { ?>
                <option value='<?php echo $row['tipoing_id']; ?>'
					<?php echo ($row['tipoing_id'] == $lug_row['tipoing_id']) ? 'selected' : ''; ?>>
					<?php echo $row['tipoing_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtLugCalificacion'>Calificacion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugCalificacion' name='txtLugCalificacion'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_calificacion'];
	           } ?>' placeholder='Ingrese calificacion'/></td>
</tr>
<tr>
    <td><label for='txtLugSituacion'>Situacion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugSituacion' name='txtLugSituacion'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_situacion'];
	           } ?>' placeholder='Ingrese situacion'/></td>
</tr>
<tr>
    <td><label for='txtLugResenia'>Resenia:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugResenia' name='txtLugResenia'
               value='<?php if ($lug_row) {
		           echo htmlspecialchars($lug_row['lug_resenia']);
	           } ?>' maxlength='500' placeholder='Ingrese resenia'/></td>
</tr>
<tr hidden>
    <td><label for='txtLugEstado'>Estado:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugEstado' name='txtLugEstado'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_estado'];
	           } ?>' placeholder='Ingrese estado'/></td>
</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
    <input class='btn b_naranja' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
    <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div>
</div>
</div>
</form>
<br/>
<script>
var lug_upd = '#frmLugarturisticoUpd';
$(document).ready(function (e) {
    $(lug_upd).find('#txtLugNombre').focus();
    $(lug_upd).find('#btnActualizar').off('click').click(function (e) {
        if (lug_validar()) {
            var lug_id            = '<?php echo $lug_id; ?>';
            var lug_nombre        = $(lug_upd).find('#txtLugNombre').val();
            var lug_tipolug_id    = $(lug_upd).find('#txtLugTipolugID').val();
            var lug_latitud_geo   = $(lug_upd).find('#txtLugLatitudGeo').val();
            var lug_longitud_geo  = $(lug_upd).find('#txtLugLongitudGeo').val();
            var lug_altitud       = $(lug_upd).find('#txtLugAltitud').val();
            var lug_tamanio_area  = $(lug_upd).find('#txtLugTamanioArea').val();
            var lug_foto          = $(lug_upd).find('#txtLugFoto').val();
            var lug_descripcion   = $(lug_upd).find('#txtLugDescripcion').val();
            var lug_ubig_id       = $(lug_upd).find('#txtLugUbigID').val();
            var lug_direccion_ref = $(lug_upd).find('#txtLugDireccionRef').val();
            var lug_tipoing_id    = $(lug_upd).find('#txtLugTipoingID').val();
            var lug_calificacion  = $(lug_upd).find('#txtLugCalificacion').val();
            var lug_situacion     = $(lug_upd).find('#txtLugSituacion').val();
            var lug_resenia       = $(lug_upd).find('#txtLugResenia').val();
            var lug_estado        = $(lug_upd).find('#txtLugEstado').val();

            $.post('lugarturistico/proceso/lugarturistico_update.php', {
                    lug_id           : lug_id,
                    lug_nombre       : lug_nombre,
                    lug_tipolug_id   : lug_tipolug_id,
                    lug_latitud_geo  : lug_latitud_geo,
                    lug_longitud_geo : lug_longitud_geo,
                    lug_altitud      : lug_altitud,
                    lug_tamanio_area : lug_tamanio_area,
                    lug_foto         : lug_foto,
                    lug_descripcion  : lug_descripcion,
                    lug_ubig_id      : lug_ubig_id,
                    lug_direccion_ref: lug_direccion_ref,
                    lug_tipoing_id   : lug_tipoing_id,
                    lug_calificacion : lug_calificacion,
                    lug_situacion    : lug_situacion,
                    lug_resenia      : lug_resenia,
                    lug_estado       : lug_estado
                },
                function (datos) {
                    if (datos == 1) {
                        alert('Actualizacion correcta');
                        volver();
                    } else {
                        alert('Error al actualizar. ' + datos);
                    }
                });
        }
    });
    $(lug_upd).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function lug_validar() {
    var lug_nombre        = $(lug_upd).find('#txtLugNombre').val();
    var lug_tipolug_id    = $(lug_upd).find('#txtLugTipolugID').val();
    var lug_latitud_geo   = $(lug_upd).find('#txtLugLatitudGeo').val();
    var lug_longitud_geo  = $(lug_upd).find('#txtLugLongitudGeo').val();
    var lug_altitud       = $(lug_upd).find('#txtLugAltitud').val();
    var lug_tamanio_area  = $(lug_upd).find('#txtLugTamanioArea').val();
    var lug_foto          = $(lug_upd).find('#txtLugFoto').val();
    var lug_descripcion   = $(lug_upd).find('#txtLugDescripcion').val();
    var lug_ubig_id       = $(lug_upd).find('#txtLugUbigID').val();
    var lug_direccion_ref = $(lug_upd).find('#txtLugDireccionRef').val();
    var lug_tipoing_id    = $(lug_upd).find('#txtLugTipoingID').val();
    var lug_calificacion  = $(lug_upd).find('#txtLugCalificacion').val();
    var lug_situacion     = $(lug_upd).find('#txtLugSituacion').val();
    var lug_resenia       = $(lug_upd).find('#txtLugResenia').val();

    if (lug_nombre == '') {
        alert('Ingrese una nombre válida de lugar turístico');
        return false;
    }
    if (!(isInteger(lug_tipolug_id) && lug_tipolug_id > 0)) {
        alert('Seleccione tipo de lugar');
        return false;
    }
    if (!isNumeric(lug_latitud_geo)) {
        alert('Ingrese latitud geo válido');
        return false;
    }
    if (!isNumeric(lug_longitud_geo)) {
        alert('Ingrese longitud geo válido');
        return false;
    }
    if (!isNumeric(lug_altitud)) {
        alert('Ingrese altitud válido');
        return false;
    }
    if (!isNumeric(lug_tamanio_area)) {
        alert('Ingrese tamanio area válido');
        return false;
    }
    if (lug_foto == '') {
        alert('Ingrese una foto válida');
        return false;
    }
    if (lug_descripcion == '') {
        alert('Ingrese una descripcion válida de lugar turístico');
        return false;
    }
    if (!(isInteger(lug_ubig_id) && lug_ubig_id > 0)) {
        alert('Seleccione ubigeo');
        return false;
    }
    if (lug_direccion_ref == '') {
        alert('Ingrese una direccion ref válida');
        return false;
    }
    if (!(isInteger(lug_tipoing_id) && lug_tipoing_id > 0)) {
        alert('Seleccione tipo de ingreso');
        return false;
    }
    if (!isTinyint(lug_calificacion)) {
        alert('Ingrese un valor de calificacion válido');
        return false;
    }
    if (!isTinyint(lug_situacion)) {
        alert('Ingrese un valor de situacion válido');
        return false;
    }
    if (lug_resenia == '') {
        alert('Ingrese una resenia válida');
        return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
