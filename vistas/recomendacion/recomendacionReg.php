<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('rec_reg', 'recomendacion/recomendacion.php');
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<?php
	include_once '../../includes/tiporecomendacionDAL.php';
	$tiporec_dal = new tiporecomendacionDAL();
?>
<form id='frmRecomendacionReg' method='post'>
<div class='regform'>
<div class='regform_body'>
    <div class='form_title'>
        <span class='h2'>Registrar recomendación</span>
    </div>
    <hr class='separator'/>
    <table class='form_data'>
        <tr>
            <td><label for='txtRecLugID'>Lugar turístico:</label></td>
            <td><select class='form-control txt250' id='txtRecLugID' name='txtRecLugID'> <!-- maxlength='10' -->
                    <option value='0'>(Seleccione)</option>
					<?php $lug_list = $lug_dal->listarcbo(); ?>
					<?php foreach ($lug_list as $row) { ?>
                        <option value='<?php echo $row['lug_id']; ?>'>
							<?php echo $row['lug_nombre']; ?>
                        </option>
					<?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for='txtRecTiporecID'>Tipo de recomendación:</label></td>
            <td><select class='form-control txt250' id='txtRecTiporecID' name='txtRecTiporecID'>
                    <!-- maxlength='10' -->
                    <option value='0'>(Seleccione)</option>
					<?php $tiporec_list = $tiporec_dal->listarcbo(); ?>
					<?php foreach ($tiporec_list as $row) { ?>
                        <option value='<?php echo $row['tiporec_id']; ?>'>
							<?php echo $row['tiporec_nombre']; ?>
                        </option>
					<?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for='txtRecDescripcion'>Descripcion:</label></td>
            <td><textarea id='txtRecDescripcion' name='txtRecDescripcion' maxlength='200' cols='40' rows='5'
                          class='form-control' placeholder='Ingrese descripcion'></textarea>
            </td>
        </tr>
    </table>
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
var rec_reg = '#frmRecomendacionReg';
$(document).ready(function (e) {
    $(rec_reg).find('#txtRecLugID').focus();
    $(rec_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (rec_validar()) {
            var rec_lug_id      = $(rec_reg).find('#txtRecLugID').val();
            var rec_tiporec_id  = $(rec_reg).find('#txtRecTiporecID').val();
            var rec_descripcion = $(rec_reg).find('#txtRecDescripcion').val();

            $.post('recomendacion/proceso/recomendacion_insert.php', {
                    rec_lug_id     : rec_lug_id,
                    rec_tiporec_id : rec_tiporec_id,
                    rec_descripcion: rec_descripcion
                },
                function (datos) {
                    if (datos > 0) {
                        alert('Registro correcto');
                        volver();
                    } else {
                        alert('Error al registrar. ' + datos);
                    }
                });
        }
    });
    $(rec_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function rec_validar() {
    var rec_lug_id      = $(rec_reg).find('#txtRecLugID').val();
    var rec_tiporec_id  = $(rec_reg).find('#txtRecTiporecID').val();
    var rec_descripcion = $(rec_reg).find('#txtRecDescripcion').val();

    if (!(isInteger(rec_lug_id) && rec_lug_id > 0)) {
        alert('Seleccione lugar turístico');
        return false;
    }
    if (!(isInteger(rec_tiporec_id) && rec_tiporec_id > 0)) {
        alert('Seleccione tipo de recomendación');
        return false;
    }
    if (rec_descripcion == '') {
        alert('Ingrese una descripcion válida de recomendación');
        return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
