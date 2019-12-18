<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('rec_upd', 'recomendacion/recomendacion.php');
?>
<?php
	include_once '../../includes/recomendacionDAL.php';
	$rec_dal = new recomendacionDAL();
	$rec_id  = GetNumericParam('rec_id');
	
	$rec_row = $rec_dal->getByID($rec_id);
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
?>
<?php
	include_once '../../includes/tiporecomendacionDAL.php';
	$tiporec_dal = new tiporecomendacionDAL();
?>
<form id='frmRecomendacionUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Editar recomendación</span>
</div>
<hr class='separator'/>
<table class='form_data'>
    <tr>
        <td><label for='txtRecLugID'>Lugar turístico:</label></td>
        <td><select class='form-control txt250' id='txtRecLugID' name='txtRecLugID'> <!-- maxlength='10' -->
                <option value='0'>(Seleccione)</option>
				<?php $lug_list = $lug_dal->listarcbo($rec_row['rec_lug_id']); ?>
				<?php foreach ($lug_list as $row) { ?>
                    <option value='<?php echo $row['lug_id']; ?>'
						<?php echo ($row['lug_id'] == $rec_row['lug_id']) ? 'selected' : ''; ?>>
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
				<?php $tiporec_list = $tiporec_dal->listarcbo($rec_row['rec_tiporec_id']); ?>
				<?php foreach ($tiporec_list as $row) { ?>
                    <option value='<?php echo $row['tiporec_id']; ?>'
						<?php echo ($row['tiporec_id'] == $rec_row['tiporec_id']) ? 'selected' : ''; ?>>
						<?php echo $row['tiporec_nombre']; ?>
                    </option>
				<?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for='txtRecDescripcion'>Descripcion:</label></td>
        <td><textarea id='txtRecDescripcion' name='txtRecDescripcion' maxlength='200' cols='40' rows='5'
                      class='form-control' placeholder='Ingrese descripcion'><?php if ($rec_row) {
					echo htmlspecialchars($rec_row['rec_descripcion']);
				} ?></textarea>
        </td>
    </tr>
    <tr hidden>
        <td><label for='txtRecEstado'>Estado:</label></td>
        <td><input type='text' class='form-control txt250' id='txtRecEstado' name='txtRecEstado'
                   value='<?php if ($rec_row) {
			           echo $rec_row['rec_estado'];
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
var rec_upd = '#frmRecomendacionUpd';
$(document).ready(function (e) {
    $(rec_upd).find('#txtRecLugID').focus();
    $(rec_upd).find('#btnActualizar').off('click').click(function (e) {
        if (rec_validar()) {
            var rec_id          = '<?php echo $rec_id; ?>';
            var rec_lug_id      = $(rec_upd).find('#txtRecLugID').val();
            var rec_tiporec_id  = $(rec_upd).find('#txtRecTiporecID').val();
            var rec_descripcion = $(rec_upd).find('#txtRecDescripcion').val();
            var rec_estado      = $(rec_upd).find('#txtRecEstado').val();

            $.post('recomendacion/proceso/recomendacion_update.php', {
                    rec_id         : rec_id,
                    rec_lug_id     : rec_lug_id,
                    rec_tiporec_id : rec_tiporec_id,
                    rec_descripcion: rec_descripcion,
                    rec_estado     : rec_estado
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
    $(rec_upd).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function rec_validar() {
    var rec_lug_id      = $(rec_upd).find('#txtRecLugID').val();
    var rec_tiporec_id  = $(rec_upd).find('#txtRecTiporecID').val();
    var rec_descripcion = $(rec_upd).find('#txtRecDescripcion').val();

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
