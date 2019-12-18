<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/rutadetDAL.php';
	$rutad_dal = new rutadetDAL();
	$b = GetStringParam('b');
	$rutad_list = $rutad_dal->listar($b);
?>
<table id='tblrutadet' class='table table-responsive txt_left'>
	<tr>
		<th>Ruta</th>
		<th>Lugar turístico</th>
		<th>ID</th>
		<th>Distancia</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($rutad_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['rutad_ruta_id']); ?></td>
		<td class='txt_center'><?php echo pad($row['rutad_lug_id']); ?></td>
		<td class='txt_center'><?php echo pad($row['rutad_nro_ord']); ?></td>
		<td class='txt_right'> <?php echo $row['rutad_distancia']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="rutad_editar('<?php echo $row['rutad_ruta_id']; ?>', '<?php echo $row['rutad_lug_id']; ?>', '<?php echo $row['rutad_nro_ord']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="rutad_borrar('<?php echo $row['rutad_ruta_id']; ?>', '<?php echo $row['rutad_lug_id']; ?>', '<?php echo $row['rutad_nro_ord']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function rutad_editar(rutad_ruta_id, rutad_lug_id, rutad_nro_ord) {
		performLoad('rutadet/rutadetUpd.php?rutad_ruta_id=' + rutad_ruta_id + '&rutad_lug_id=' + rutad_lug_id + '&rutad_nro_ord=' + rutad_nro_ord);
	}
	function rutad_borrar(rutad_ruta_id, rutad_lug_id, rutad_nro_ord) {
		if (confirm("¿Borrar detalle de ruta?")) {
			$.post('rutadet/proceso/rutadet_borrar.php', {
				rutad_ruta_id: rutad_ruta_id,
rutad_lug_id: rutad_lug_id,
rutad_nro_ord: rutad_nro_ord
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
	function rutad_activar(rutad_ruta_id, rutad_lug_id, rutad_nro_ord) {
		if (confirm("¿Activar detalle de ruta?")) {
			$.post('rutadet/proceso/rutadet_activar.php', {
				rutad_ruta_id: rutad_ruta_id,
rutad_lug_id: rutad_lug_id,
rutad_nro_ord: rutad_nro_ord
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