<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/cercaniaDAL.php';
	$cerca_dal = new cercaniaDAL();
	$b = GetStringParam('b');
	$cerca_list = $cerca_dal->listar($b);
?>
<table id='tblcercania' class='table table-responsive'>
	<tr>
		<th>Lugar turístico</th>
		<th>Sitio</th>
		<th>Distancia</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($cerca_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['cerca_lug_id']); ?></td>
		<td class='txt_center'><?php echo pad($row['cerca_sitio_id']); ?></td>
		<td class='txt_right'> <?php echo $row['cerca_distancia']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="cerca_editar('<?php echo $row['cerca_lug_id']; ?>', '<?php echo $row['cerca_sitio_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="cerca_borrar('<?php echo $row['cerca_lug_id']; ?>', '<?php echo $row['cerca_sitio_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function cerca_editar(cerca_lug_id, cerca_sitio_id) {
		performLoad('cercania/cercaniaUpd.php?cerca_lug_id=' + cerca_lug_id + '&cerca_sitio_id=' + cerca_sitio_id);
	}
	function cerca_borrar(cerca_lug_id, cerca_sitio_id) {
		if (confirm("¿Borrar cercanía?")) {
			$.post('cercania/proceso/cercania_borrar.php', {
				cerca_lug_id: cerca_lug_id,
cerca_sitio_id: cerca_sitio_id
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
	function cerca_activar(cerca_lug_id, cerca_sitio_id) {
		if (confirm("¿Activar cercanía?")) {
			$.post('cercania/proceso/cercania_activar.php', {
				cerca_lug_id: cerca_lug_id,
cerca_sitio_id: cerca_sitio_id
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