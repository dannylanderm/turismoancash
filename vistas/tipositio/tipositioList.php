<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/tipositioDAL.php';
	$tipositio_dal = new tipositioDAL();
	$b = GetStringParam('b');
	$tipositio_list = $tipositio_dal->listar($b);
?>
<table id='tbltipositio' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tipositio_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tipositio_id']); ?></td>
		<td><?php echo $row['tipositio_nombre']; ?></td>
		<td hidden><?php echo $row['tipositio_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="tipositio_editar('<?php echo $row['tipositio_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="tipositio_borrar('<?php echo $row['tipositio_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tipositio_editar(tipositio_id) {
		performLoad('tipositio/tipositioUpd.php?tipositio_id=' + tipositio_id);
	}
	function tipositio_borrar(tipositio_id) {
		if (confirm("¿Borrar tipo de sitio?")) {
			$.post('tipositio/proceso/tipositio_borrar.php', {
				tipositio_id: tipositio_id
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
	function tipositio_activar(tipositio_id) {
		if (confirm("¿Activar tipo de sitio?")) {
			$.post('tipositio/proceso/tipositio_activar.php', {
				tipositio_id: tipositio_id
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