<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('lug_reg', 'lugarturistico/lugarturistico.php');
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
<form id='frmLugarturisticoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Registrar lugar turístico</span>
</div>
<hr class='separator'/>
<div class='txt_center'>
<div class='inline txt_left' style='vertical-align: top;'>
<table class='form_data'>
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
    <td><label for='txtLugNombre'>Nombre:</label></td>
    <td><input type='text' class='form-control txt320' id='txtLugNombre' name='txtLugNombre' maxlength='100'
               value='<?php if ($lug_row) {
		           echo htmlspecialchars($lug_row['lug_nombre']);
	           } ?>' placeholder='Nombre del lugar turístico'/></td>
</tr>
<tr>
    <td><label for='txtLugDescripcion'>Descripción:</label></td>
    <td><textarea id='txtLugDescripcion' name='txtLugDescripcion' maxlength='400' rows='4'
                  class='form-control' placeholder='Descripción del lugar'><?php if ($lug_row) {
				echo htmlspecialchars($lug_row['lug_descripcion']);
			} ?></textarea>
    </td>
</tr>
<tr>
    <td><label for='txtLugResenia'>Historia:</label></td>
    <td><textarea id='txtLugResenia' name='txtLugResenia' maxlength='500' rows='6'
                  class='form-control'
                  placeholder='Breve descripción histórica del lugar (opcional)'><?php if ($lug_row) {
				echo htmlspecialchars($lug_row['lug_resenia']);
			} ?></textarea>
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
    <td><label for='txtLugLatitudGeo'>Latitud y longitud:</label></td>
    <td><input type='text' class='form-control txt120 inline' id='txtLugLatitudGeo' name='txtLugLatitudGeo'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_latitud_geo'];
	           } ?>' maxlength='16' placeholder='Latitud'/>
        <input type='text' class='form-control txt120 inline' id='txtLugLongitudGeo' name='txtLugLongitudGeo'
               value='<?php if ($lug_row) {
			       echo $lug_row['lug_longitud_geo'];
		       } ?>' maxlength='16' placeholder='Longitud'/>
    </td>
</tr>
<tr>
    <td><label for='txtLugAltitud'>Altitud:</label></td>
    <td><input type='text' class='form-control txt120 inline' id='txtLugAltitud' name='txtLugAltitud' maxlength='9'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_altitud'];
	           } ?>' placeholder='Ingrese altitud'/> m.s.n.m.
    </td>
</tr>
<tr>
    <td><label for='txtLugTamanioArea'>Área geográfica:</label></td>
    <td><input type='text' class='form-control txt120 inline' id='txtLugTamanioArea' name='txtLugTamanioArea'
               maxlength='9' value='<?php if ($lug_row) {
			echo $lug_row['lug_tamanio_area'];
		} ?>' placeholder='Área (Km2)'/> Km2
    </td>
</tr>
<tr hidden>
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
<tr hidden>
    <td><label for='txtLugDireccionRef'>Dirección:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugDireccionRef' name='txtLugDireccionRef' maxlength='100'
               value='<?php if ($lug_row) {
		           echo htmlspecialchars($lug_row['lug_direccion_ref']);
	           } ?>' placeholder='Ingrese direccion ref'/></td>
</tr>
<tr hidden>
    <td><label for='txtLugCalificacion'>Calificacion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugCalificacion' name='txtLugCalificacion'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_calificacion'];
	           } else {
		           echo 0;
	           } ?>' placeholder='Ingrese calificacion'/></td>
</tr>
<tr hidden>
    <td><label for='txtLugSituacion'>Situacion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtLugSituacion' name='txtLugSituacion'
               value='<?php if ($lug_row) {
		           echo $lug_row['lug_situacion'];
	           } else {
		           echo 1;
	           } ?>' placeholder='Ingrese situacion'/></td>
</tr>
</table>
</div>
<div class='inline txt_left' style='vertical-align: top;'>
    <label for='txtLugFoto'>Foto:</label>
    <a href='#' id='btnQuitarLugFoto' class='btn btn-danger' style='float: right'>Quitar</a>
    <a href='#' id='btnAdjuntarLugFoto' class='btn btn-default' style='float: right'>Adjuntar</a>
    <input type='file' id='fileLugFoto' name='fileLugFoto' maxlength='255'
           class='hidden form-control txt250' placeholder='Ingrese logo' autocomplete='off'><br>

    <div class='rpad3'>
        <img id='imgLugFoto' style='width: 333px;' src='<?php if ($lug_row) {
			echo $lug_row['lug_foto'] ? '../'.htmlspecialchars($lug_row['lug_foto']) : '../resources/img/utils/img_80x120.png';
		} else {
			echo '../resources/img/utils/img_80x120.png';
		} ?>' class='w100p b_gris bglb_gris' alt=''>
    </div>
    <div class='map' id='divMapa' style='width: 500px; height: 400px;'></div>
</div>
</div>
<hr class='separator'/>
<div class='form_foot'>
    <input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
    <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div>
</div>
</div>
</form>
<br/>
<script>
var lug_reg = '#frmLugarturisticoReg';

$(document).ready(function (e) {
    $(lug_reg).find('#txtLugNombre').focus();

    iniciarMapa('divMapa', {
        lat: -74.524,
        lng: -57.859
    });

    $('#btnAdjuntarLugFoto').off('click').click(function () {
        $('#fileLugFoto').trigger('click');
    });

    var lug_foto_contenido_deleted = 0;
    $('#btnQuitarLugFoto').off('click').click(function () {
        lug_foto_contenido_deleted = 1;
        $('#fileLugFoto').val('');
        $('#imgLugFoto').attr('src', '../recursos/img/utils/img_80x120.png');
    });

    $('#fileLugFoto').change(function () {
        showImagePreview('#imgLugFoto', this);
    });

    $(lug_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (lug_validar()) {
            var lug_id            = toInteger('<?php echo $lug_id; ?>');
            var lug_nombre        = $(lug_reg).find('#txtLugNombre').val();
            var lug_tipolug_id    = $(lug_reg).find('#txtLugTipolugID').val();
            var lug_latitud_geo   = $(lug_reg).find('#txtLugLatitudGeo').val();
            var lug_longitud_geo  = $(lug_reg).find('#txtLugLongitudGeo').val();
            var lug_altitud       = $(lug_reg).find('#txtLugAltitud').val();
            var lug_tamanio_area  = $(lug_reg).find('#txtLugTamanioArea').val();
            var lug_foto          = $(lug_reg).find('#fileLugFoto').prop('files');
            var lug_descripcion   = $(lug_reg).find('#txtLugDescripcion').val();
            var lug_ubig_id       = $(lug_reg).find('#txtLugUbigID').val();
            var lug_direccion_ref = $(lug_reg).find('#txtLugDireccionRef').val();
            var lug_tipoing_id    = $(lug_reg).find('#txtLugTipoingID').val();
            var lug_calificacion  = $(lug_reg).find('#txtLugCalificacion').val();
            var lug_situacion     = $(lug_reg).find('#txtLugSituacion').val();
            var lug_resenia       = $(lug_reg).find('#txtLugResenia').val();

            var form_data = new FormData();
            form_data.append('lug_id', lug_id);
            form_data.append('lug_nombre', lug_nombre);
            form_data.append('lug_tipolug_id', lug_tipolug_id);
            form_data.append('lug_latitud_geo', lug_latitud_geo);
            form_data.append('lug_longitud_geo', lug_longitud_geo);
            form_data.append('lug_altitud', lug_altitud);
            form_data.append('lug_tamanio_area', lug_tamanio_area);
            form_data.append('lug_foto', lug_foto ? lug_foto[0] : null);
            form_data.append('lug_foto_contenido_deleted', lug_foto_contenido_deleted);
            form_data.append('lug_descripcion', lug_descripcion);
            form_data.append('lug_ubig_id', lug_ubig_id);
            form_data.append('lug_direccion_ref', lug_direccion_ref);
            form_data.append('lug_tipoing_id', lug_tipoing_id);
            form_data.append('lug_calificacion', lug_calificacion);
            form_data.append('lug_situacion', lug_situacion);
            form_data.append('lug_resenia', lug_resenia);

            $.ajax({
                url        : lug_id > 0 ? 'lugarturistico/proceso/lugarturistico_update.php' : 'lugarturistico/proceso/lugarturistico_insert.php',
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
    $(lug_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function lug_validar() {
    var lug_nombre        = $(lug_reg).find('#txtLugNombre').val();
    var lug_tipolug_id    = $(lug_reg).find('#txtLugTipolugID').val();
    var lug_latitud_geo   = $(lug_reg).find('#txtLugLatitudGeo').val();
    var lug_longitud_geo  = $(lug_reg).find('#txtLugLongitudGeo').val();
    var lug_altitud       = $(lug_reg).find('#txtLugAltitud').val();
    var lug_tamanio_area  = $(lug_reg).find('#txtLugTamanioArea').val();
    var lug_foto          = $(lug_reg).find('#txtLugFoto').val();
    var lug_descripcion   = $(lug_reg).find('#txtLugDescripcion').val();
    var lug_ubig_id       = $(lug_reg).find('#txtLugUbigID').val();
    var lug_direccion_ref = $(lug_reg).find('#txtLugDireccionRef').val();
    var lug_tipoing_id    = $(lug_reg).find('#txtLugTipoingID').val();
    var lug_calificacion  = $(lug_reg).find('#txtLugCalificacion').val();
    var lug_situacion     = $(lug_reg).find('#txtLugSituacion').val();
    var lug_resenia       = $(lug_reg).find('#txtLugResenia').val();

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
        // alert('Ingrese una foto válida');
        // return false;
    }
    if (lug_descripcion == '') {
        alert('Ingrese una descripcion válida de lugar turístico');
        return false;
    }
    if (!(isInteger(lug_ubig_id) && lug_ubig_id > 0)) {
        // alert('Seleccione ubigeo');
        // return false;
    }
    if (lug_direccion_ref == '') {
        // alert('Ingrese una direccion ref válida');
        // return false;
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
        // alert('Ingrese una resenia válida');
        // return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
