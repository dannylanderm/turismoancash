<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/tiporecomendacionDAL.php';
	$tiporec_dal = new tiporecomendacionDAL();
	$b = GetStringParam('b');
	$tiporec_list = $tiporec_dal->listar($b);
?>
<table id='tbltiporecomendacion' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tiporec_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tiporec_id']); ?></td>
		<td><?php echo $row['tiporec_nombre']; ?></td>
		<td hidden><?php echo $row['tiporec_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="tiporec_editar('<?php echo $row['tiporec_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="tiporec_borrar('<?php echo $row['tiporec_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tiporec_editar(tiporec_id) {
		performLoad('tiporecomendacion/tiporecomendacionUpd.php?tiporec_id=' + tiporec_id);
	}
	function tiporec_borrar(tiporec_id) {
		if (confirm("¿Borrar tipo de recomendación?")) {
			$.post('tiporecomendacion/proceso/tiporecomendacion_borrar.php', {
				tiporec_id: tiporec_id
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
	function tiporec_activar(tiporec_id) {
		if (confirm("¿Activar tipo de recomendación?")) {
			$.post('tiporecomendacion/proceso/tiporecomendacion_activar.php', {
				tiporec_id: tiporec_id
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