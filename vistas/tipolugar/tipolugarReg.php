<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tipolug_reg', 'tipolugar/tipolugar.php');
?>
<?php
	include_once '../../includes/categorialugarDAL.php';
	$catlug_dal = new categorialugarDAL();
?>
<form id='frmTipolugarReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo de lugar</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTipolugCatlugID'>Categoría: </label></td>
		<td><select class='form-control txt250'  id='txtTipolugCatlugID' name='txtTipolugCatlugID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $catlug_list = $catlug_dal->listarcbo(); ?>
			<?php foreach($catlug_list as $row) { ?>
				<option value='<?php echo $row['catlug_id']; ?>'>
					<?php echo $row['catlug_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
    <tr><td><label for='txtTipolugNombre'>Nombre: </label></td>
        <td><input type='text' class='form-control txt300' id='txtTipolugNombre' name='txtTipolugNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var tipolug_reg = '#frmTipolugarReg';
$(document).ready(function(e) {
	$(tipolug_reg).find('#txtTipolugNombre').focus();
	$(tipolug_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tipolug_validar()){
			var tipolug_nombre = $(tipolug_reg).find('#txtTipolugNombre').val();
			var tipolug_catlug_id = $(tipolug_reg).find('#txtTipolugCatlugID').val();

			$.post('tipolugar/proceso/tipolugar_insert.php',{
				tipolug_nombre : tipolug_nombre,
				tipolug_catlug_id : tipolug_catlug_id
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
	$(tipolug_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tipolug_validar() {
	var tipolug_nombre = $(tipolug_reg).find('#txtTipolugNombre').val();
	var tipolug_catlug_id = $(tipolug_reg).find('#txtTipolugCatlugID').val();

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