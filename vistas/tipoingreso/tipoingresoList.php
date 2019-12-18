<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/tipoingresoDAL.php';
	$tipoing_dal = new tipoingresoDAL();
	$b = GetStringParam('b');
	$tipoing_list = $tipoing_dal->listar($b);
?>
<table id='tbltipoingreso' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tipoing_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tipoing_id']); ?></td>
		<td><?php echo $row['tipoing_nombre']; ?></td>
		<td hidden><?php echo $row['tipoing_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="tipoing_editar('<?php echo $row['tipoing_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="tipoing_borrar('<?php echo $row['tipoing_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tipoing_editar(tipoing_id) {
		performLoad('tipoingreso/tipoingresoUpd.php?tipoing_id=' + tipoing_id);
	}
	function tipoing_borrar(tipoing_id) {
		if (confirm("¿Borrar tipo de ingreso?")) {
			$.post('tipoingreso/proceso/tipoingreso_borrar.php', {
				tipoing_id: tipoing_id
			},
			function (datos) {
				if (datos > 0) {
					alert('Borrado correcto');
					volver();
				} else {
					alert('Error al borrar. ' + datos);
				}
			});
		}
	}
	function tipoing_activar(tipoing_id) {
		if (confirm("¿Activar tipo de ingreso?")) {
			$.post('tipoingreso/proceso/tipoingreso_activar.php', {
				tipoing_id: tipoing_id
			},
			function (datos) {
				if (datos > 0) {
					alert('Activado correcto');
					volver();
				} else {
					alert('Error al activar. ' + datos);
				}
			});
		}
	}
</script>