<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/tipolugarDAL.php';
	$tipolug_dal = new tipolugarDAL();
	$b = GetStringParam('b');
	$tipolug_list = $tipolug_dal->listar($b);
?>
<table id='tbltipolugar' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Categoría de lugar</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tipolug_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tipolug_id']); ?></td>
		<td><?php echo $row['tipolug_nombre']; ?></td>
		<td><?php echo $row['catlug_nombre']; ?></td>
		<td hidden><?php echo $row['tipolug_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="tipolug_editar('<?php echo $row['tipolug_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="tipolug_borrar('<?php echo $row['tipolug_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tipolug_editar(tipolug_id) {
		performLoad('tipolugar/tipolugarUpd.php?tipolug_id=' + tipolug_id);
	}
	function tipolug_borrar(tipolug_id) {
		if (confirm("¿Borrar tipo de lugar?")) {
			$.post('tipolugar/proceso/tipolugar_borrar.php', {
				tipolug_id: tipolug_id
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
	function tipolug_activar(tipolug_id) {
		if (confirm("¿Activar tipo de lugar?")) {
			$.post('tipolugar/proceso/tipolugar_activar.php', {
				tipolug_id: tipolug_id
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