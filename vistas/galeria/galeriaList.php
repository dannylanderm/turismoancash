<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/galeriaDAL.php';
	$gal_dal = new galeriaDAL();
	$b = GetStringParam('b');
	$gal_list = $gal_dal->listar($b);
?>
<table id='tblgaleria' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Lugar turístico</th>
		<th>Foto</th>
		<th>Foto descripcion</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($gal_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['gal_id']); ?></td>
		<td><?php echo $row['lug_nombre']; ?></td>
		<td><?php echo $row['gal_foto']; ?></td>
		<td><?php echo $row['gal_foto_descripcion']; ?></td>
		<td hidden><?php echo $row['gal_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="gal_editar('<?php echo $row['gal_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="gal_borrar('<?php echo $row['gal_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function gal_editar(gal_id) {
		performLoad('galeria/galeriaUpd.php?gal_id=' + gal_id);
	}
	function gal_borrar(gal_id) {
		if (confirm("¿Borrar galería?")) {
			$.post('galeria/proceso/galeria_borrar.php', {
				gal_id: gal_id
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
	function gal_activar(gal_id) {
		if (confirm("¿Activar galería?")) {
			$.post('galeria/proceso/galeria_activar.php', {
				gal_id: gal_id
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