<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/rutaDAL.php';
	$ruta_dal = new rutaDAL();
	$b = GetStringParam('b');
	$ruta_list = $ruta_dal->listar($b);
?>
<table id='tblruta' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Descripcion</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($ruta_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['ruta_id']); ?></td>
		<td><?php echo $row['ruta_descripcion']; ?></td>
		<td class='txt_center' hidden><?php echo $row['ruta_fecha_reg']; ?></td>
		<td hidden><?php echo $row['ruta_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="ruta_editar('<?php echo $row['ruta_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="ruta_borrar('<?php echo $row['ruta_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function ruta_editar(ruta_id) {
		performLoad('ruta/rutaUpd.php?ruta_id=' + ruta_id);
	}
	function ruta_borrar(ruta_id) {
		if (confirm("¿Borrar ruta?")) {
			$.post('ruta/proceso/ruta_borrar.php', {
				ruta_id: ruta_id
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
	function ruta_activar(ruta_id) {
		if (confirm("¿Activar ruta?")) {
			$.post('ruta/proceso/ruta_activar.php', {
				ruta_id: ruta_id
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