<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/recomendacionDAL.php';
	$rec_dal = new recomendacionDAL();
	$b = GetStringParam('b');
	$rec_list = $rec_dal->listar($b);
?>
<table id='tblrecomendacion' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Lugar turístico</th>
		<th>Tipo de recomendación</th>
		<th>Descripcion</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($rec_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['rec_id']); ?></td>
		<td><?php echo $row['lug_nombre']; ?></td>
		<td><?php echo $row['tiporec_nombre']; ?></td>
		<td><?php echo $row['rec_descripcion']; ?></td>
		<td hidden><?php echo $row['rec_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="rec_editar('<?php echo $row['rec_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="rec_borrar('<?php echo $row['rec_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function rec_editar(rec_id) {
		performLoad('recomendacion/recomendacionUpd.php?rec_id=' + rec_id);
	}
	function rec_borrar(rec_id) {
		if (confirm("¿Borrar recomendación?")) {
			$.post('recomendacion/proceso/recomendacion_borrar.php', {
				rec_id: rec_id
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
	function rec_activar(rec_id) {
		if (confirm("¿Activar recomendación?")) {
			$.post('recomendacion/proceso/recomendacion_activar.php', {
				rec_id: rec_id
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