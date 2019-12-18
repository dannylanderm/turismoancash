<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/tipoactividadDAL.php';
	$tipoactiv_dal = new tipoactividadDAL();
	$b = GetStringParam('b');
	$tipoactiv_list = $tipoactiv_dal->listar($b);
?>
<table id='tbltipoactividad' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tipoactiv_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tipoactiv_id']); ?></td>
		<td><?php echo $row['tipoactiv_nombre']; ?></td>
		<td hidden><?php echo $row['tipoactiv_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="tipoactiv_editar('<?php echo $row['tipoactiv_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="tipoactiv_borrar('<?php echo $row['tipoactiv_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tipoactiv_editar(tipoactiv_id) {
		performLoad('tipoactividad/tipoactividadUpd.php?tipoactiv_id=' + tipoactiv_id);
	}
	function tipoactiv_borrar(tipoactiv_id) {
		if (confirm("¿Borrar tipo de actividad?")) {
			$.post('tipoactividad/proceso/tipoactividad_borrar.php', {
				tipoactiv_id: tipoactiv_id
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
	function tipoactiv_activar(tipoactiv_id) {
		if (confirm("¿Activar tipo de actividad?")) {
			$.post('tipoactividad/proceso/tipoactividad_activar.php', {
				tipoactiv_id: tipoactiv_id
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