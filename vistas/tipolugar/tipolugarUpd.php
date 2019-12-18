<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tipolug_upd', 'tipolugar/tipolugar.php');
?>
<?php
	include_once '../../includes/tipolugarDAL.php';
	$tipolug_dal = new tipolugarDAL();
	$tipolug_id  = GetNumericParam('tipolug_id');
	
	$tipolug_row = $tipolug_dal->getByID($tipolug_id);
?>
<?php
	include_once '../../includes/categorialugarDAL.php';
	$catlug_dal = new categorialugarDAL();
?>
<form id='frmTipolugarUpd' method='post'>
    <div class='regform'>
        <div class='regform_body'>
            <div class='form_title'>
                <span class='h2'>Editar tipo de lugar</span>
            </div>
            <hr class='separator'/>
            <table class='form_data'>
                <tr>
                    <td><label for='txtTipolugCatlugID'>Categoría: </label></td>
                    <td><select class='form-control txt250' id='txtTipolugCatlugID' name='txtTipolugCatlugID'>
                            <!-- maxlength='10' -->
                            <option value='0'>(Seleccione)</option>
							<?php $catlug_list = $catlug_dal->listarcbo($tipolug_row['tipolug_catlug_id']); ?>
							<?php foreach ($catlug_list as $row) { ?>
                                <option value='<?php echo $row['catlug_id']; ?>'
									<?php echo ($row['catlug_id'] == $tipolug_row['catlug_id']) ? 'selected' : ''; ?>>
									<?php echo $row['catlug_nombre']; ?>
                                </option>
							<?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for='txtTipolugNombre'>Nombre: </label></td>
                    <td><input type='text' class='form-control txt300' id='txtTipolugNombre' name='txtTipolugNombre'
                               value='<?php if ($tipolug_row) {
						           echo htmlspecialchars($tipolug_row['tipolug_nombre']);
					           } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
                </tr>
                <tr hidden>
                    <td><label for='txtTipolugEstado'>Estado:</label></td>
                    <td><input type='text' class='form-control txt250' id='txtTipolugEstado' name='txtTipolugEstado'
                               value='<?php if ($tipolug_row) {
						           echo $tipolug_row['tipolug_estado'];
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
var tipolug_upd = '#frmTipolugarUpd';
$(document).ready(function (e) {
    $(tipolug_upd).find('#txtTipolugNombre').focus();
    $(tipolug_upd).find('#btnActualizar').off('click').click(function (e) {
        if (tipolug_validar()) {
            var tipolug_id        = '<?php echo $tipolug_id; ?>';
            var tipolug_nombre    = $(tipolug_upd).find('#txtTipolugNombre').val();
            var tipolug_catlug_id = $(tipolug_upd).find('#txtTipolugCatlugID').val();
            var tipolug_estado    = $(tipolug_upd).find('#txtTipolugEstado').val();

            $.post('tipolugar/proceso/tipolugar_update.php', {
                    tipolug_id       : tipolug_id,
                    tipolug_nombre   : tipolug_nombre,
                    tipolug_catlug_id: tipolug_catlug_id,
                    tipolug_estado   : tipolug_estado
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
    $(tipolug_upd).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function tipolug_validar() {
    var tipolug_nombre    = $(tipolug_upd).find('#txtTipolugNombre').val();
    var tipolug_catlug_id = $(tipolug_upd).find('#txtTipolugCatlugID').val();

    if (tipolug_nombre == '') {
        alert('Ingrese una nombre válida de tipo de lugar');
        return false;
    }
    if (!(isInteger(tipolug_catlug_id) && tipolug_catlug_id > 0)) {
        alert('Seleccione categoría de lugar');
        return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>