<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('sitio_reg', 'sitio/sitio.php');
?>
<?php
	include_once '../../includes/sitioDAL.php';
	$sitio_dal = new sitioDAL();
	$sitio_id  = GetNumericParam('sitio_id');
	$sitio_row = $sitio_dal->getByID($sitio_id);
?>
<?php
	include_once '../../includes/tipositioDAL.php';
	$tipositio_dal = new tipositioDAL();
?>
<?php
	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmSitioReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Registrar sitio</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr>
    <td colspan='2' style='border-bottom: 1px solid  #dddddd;'>
        <span class='bold azul'>Datos:</span>
    </td>
</tr>
<tr>
    <td><label for='txtSitioTipositioID'>Tipo de sitio:</label></td>
    <td style='padding-top: 5px;'>
        <select class='form-control txt250' id='txtSitioTipositioID' name='txtSitioTipositioID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $tipositio_list = $tipositio_dal->listarcbo($sitio_row['sitio_tipositio_id']); ?>
			<?php foreach ($tipositio_list as $row) { ?>
                <option value='<?php echo $row['tipositio_id']; ?>'
					<?php echo ($row['tipositio_id'] == $sitio_row['tipositio_id']) ? 'selected' : ''; ?>>
					<?php echo $row['tipositio_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtSitioNombre'>Nombre sitio:</label></td>
    <td><input type='text' class='form-control txt300' id='txtSitioNombre' name='txtSitioNombre'
               value='<?php if ($sitio_row) {
		           echo htmlspecialchars($sitio_row['sitio_nombre']);
	           } ?>' maxlength='50' placeholder='Nombre del sitio'/></td>
</tr>
<tr>
    <td><label for='txtSitioLatitudGeo'>Coordenadas:</label></td>
    <td><input type='text' class='form-control inline txt120' id='txtSitioLatitudGeo' name='txtSitioLatitudGeo'
               value='<?php if ($sitio_row) {
		           echo $sitio_row['sitio_latitud_geo'];
	           } ?>' maxlength='16' placeholder='Latitud'/>
        <input type='text' class='form-control inline txt120' id='txtSitioLongitudGeo' name='txtSitioLongitudGeo'
               value='<?php if ($sitio_row) {
			       echo $sitio_row['sitio_longitud_geo'];
		       } ?>' maxlength='16' placeholder='Longitud'/>
    </td>
</tr>
<tr>
    <td colspan='2' style='border-bottom: 1px solid  #dddddd;'>
        <span class='bold azul'>Contacto:</span>
    </td>
</tr>
<tr>
    <td><label for='txtSitioCelular'>Celular:</label></td>
    <td style='padding-top: 5px;'>
        <input type='text' class='form-control txt250' id='txtSitioCelular' name='txtSitioCelular'
               value='<?php if ($sitio_row) {
			       echo htmlspecialchars($sitio_row['sitio_celular']);
		       } ?>' maxlength='50' placeholder='Ingrese celular'/></td>
</tr>
<tr>
    <td><label for='txtSitioTelefono'>Telefono:</label></td>
    <td><input type='text' class='form-control txt250' id='txtSitioTelefono' name='txtSitioTelefono'
               value='<?php if ($sitio_row) {
		           echo htmlspecialchars($sitio_row['sitio_telefono']);
	           } ?>' maxlength='50' placeholder='Ingrese telefono'/></td>
</tr>
<tr>
    <td><label for='txtSitioWebpage'>Webpage:</label></td>
    <td><input type='text' class='form-control txt250' id='txtSitioWebpage' name='txtSitioWebpage'
               value='<?php if ($sitio_row) {
		           echo htmlspecialchars($sitio_row['sitio_webpage']);
	           } ?>' maxlength='100' placeholder='Ingrese webpage'/></td>
</tr>
<tr hidden>
    <td><label for='txtSitioUbigID'>Ubigeo:</label></td>
    <td><select class='form-control txt250' id='txtSitioUbigID' name='txtSitioUbigID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo(); ?>
			<?php foreach ($ubig_list as $row) { ?>
                <option value='<?php echo $row['ubig_id']; ?>'
					<?php echo ($row['ubig_id'] == $sitio_row['ubig_id']) ? 'selected' : ''; ?>>
					<?php echo $row['ubig_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtSitioDireccion'>Dirección:</label></td>
    <td> <textarea id='txtSitioDireccion' name='txtSitioDireccion' maxlength='200' cols='30' rows='2'
                   class='form-control' placeholder='Ingrese direccion'><?php if ($sitio_row) {
				echo htmlspecialchars($sitio_row['sitio_direccion']);
			} ?></textarea>
    </td>
</tr>
<tr hidden>
    <td><label for='txtSitioCalificacion'>Calificacion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtSitioCalificacion' name='txtSitioCalificacion'
               value='<?php if ($sitio_row) {
		           echo $sitio_row['sitio_calificacion'];
	           } ?>' placeholder='Ingrese calificacion'/></td>
</tr>
<tr hidden>
    <td><label for='txtSitioSituacion'>Situacion:</label></td>
    <td><input type='text' class='form-control txt250' id='txtSitioSituacion' name='txtSitioSituacion'
               value='<?php if ($sitio_row) {
		           echo $sitio_row['sitio_situacion'];
	           } else {
		           echo 1;
	           } ?>' placeholder='Ingrese situacion'/>
    </td>
</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
    <input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Guardar'/>
    <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div>
</div>
</div>
</form>
<br/>
<script>
var sitio_reg = '#frmSitioReg';
$(document).ready(function (e) {
    $(sitio_reg).find('#txtSitioNombre').focus();
    $(sitio_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (sitio_validar()) {
            var sitio_id           = toInteger('<?= $sitio_id ?>');
            var sitio_nombre       = $(sitio_reg).find('#txtSitioNombre').val();
            var sitio_tipositio_id = $(sitio_reg).find('#txtSitioTipositioID').val();
            var sitio_latitud_geo  = $(sitio_reg).find('#txtSitioLatitudGeo').val();
            var sitio_longitud_geo = $(sitio_reg).find('#txtSitioLongitudGeo').val();
            var sitio_celular      = $(sitio_reg).find('#txtSitioCelular').val();
            var sitio_telefono     = $(sitio_reg).find('#txtSitioTelefono').val();
            var sitio_webpage      = $(sitio_reg).find('#txtSitioWebpage').val();
            var sitio_ubig_id      = $(sitio_reg).find('#txtSitioUbigID').val();
            var sitio_direccion    = $(sitio_reg).find('#txtSitioDireccion').val();
            var sitio_calificacion = $(sitio_reg).find('#txtSitioCalificacion').val();
            var sitio_situacion    = $(sitio_reg).find('#txtSitioSituacion').val();

            $.post('sitio/proceso/' + (sitio_id === 0 ? 'sitio_insert.php' : 'sitio_update.php'), {
                    sitio_id          : sitio_id,
                    sitio_nombre      : sitio_nombre,
                    sitio_tipositio_id: sitio_tipositio_id,
                    sitio_latitud_geo : sitio_latitud_geo,
                    sitio_longitud_geo: sitio_longitud_geo,
                    sitio_celular     : sitio_celular,
                    sitio_telefono    : sitio_telefono,
                    sitio_webpage     : sitio_webpage,
                    sitio_ubig_id     : sitio_ubig_id,
                    sitio_direccion   : sitio_direccion,
                    sitio_calificacion: sitio_calificacion,
                    sitio_situacion   : sitio_situacion
                },
                function (datos) {
                    if (datos > 0) {
                        alert('Guardado correcto');
                        volver();
                    } else {
                        alert('Error al guardar. ' + datos);
                    }
                });
        }
    });
    $(sitio_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function sitio_validar() {
    var sitio_nombre       = $(sitio_reg).find('#txtSitioNombre').val();
    var sitio_tipositio_id = $(sitio_reg).find('#txtSitioTipositioID').val();
    var sitio_latitud_geo  = $(sitio_reg).find('#txtSitioLatitudGeo').val();
    var sitio_longitud_geo = $(sitio_reg).find('#txtSitioLongitudGeo').val();
    var sitio_celular      = $(sitio_reg).find('#txtSitioCelular').val();
    var sitio_telefono     = $(sitio_reg).find('#txtSitioTelefono').val();
    var sitio_webpage      = $(sitio_reg).find('#txtSitioWebpage').val();
    var sitio_ubig_id      = $(sitio_reg).find('#txtSitioUbigID').val();
    var sitio_direccion    = $(sitio_reg).find('#txtSitioDireccion').val();
    var sitio_calificacion = $(sitio_reg).find('#txtSitioCalificacion').val();
    var sitio_situacion    = $(sitio_reg).find('#txtSitioSituacion').val();

    if (sitio_nombre == '') {
        alert('Ingrese un nombre válido de sitio');
        return false;
    }
    if (!(isInteger(sitio_tipositio_id) && sitio_tipositio_id > 0)) {
        alert('Seleccione tipo de sitio');
        return false;
    }
    if (!isNumeric(sitio_latitud_geo)) {
        alert('Ingrese latitud geografica válida');
        return false;
    }
    if (!isNumeric(sitio_longitud_geo)) {
        alert('Ingrese longitud geografica válida');
        return false;
    }
    if (sitio_celular == '') {
        // alert('Ingrese una celular válida');
        // return false;
    }
    if (sitio_telefono == '') {
        alert('Ingrese un telefono válido');
        return false;
    }
    if (sitio_webpage == '') {
        // alert('Ingrese una webpage válida');
        // return false;
    }
    if (!(isInteger(sitio_ubig_id) && sitio_ubig_id > 0)) {
        // alert('Seleccione ubigeo');
        // return false;
    }
    if (sitio_direccion == '') {
        alert('Ingrese una direccion válida');
        return false;
    }
    if (!isTinyint(sitio_calificacion)) {
        // alert('Ingrese un valor de calificacion válido');
        // return false;
    }
    if (!isTinyint(sitio_situacion)) {
        // alert('Ingrese un valor de situacion válido');
        // return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
