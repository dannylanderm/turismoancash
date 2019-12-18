<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/rolDAL.php';
	$rol_dal = new rolDAL();
	$b = GetStringParam('b');
	$rol_list = $rol_dal->listar($b);
?>
<table id='tblrol' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th hidden>Editar</th>
		<th hidden>Borrar</th>
	</tr>
	<?php foreach($rol_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['rol_id']); ?></td>
		<td><?php echo $row['rol_nombre']; ?></td>
		<td hidden><?php echo $row['rol_estado']; ?></td>
		<td hidden class='txt_center'><a href='#' class='btn btn-info' onclick="rol_editar('<?php echo $row['rol_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td hidden class='txt_center'><a href='#'  class='btn btn-danger' onclick="rol_borrar('<?php echo $row['rol_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function rol_editar(rol_id) {
		performLoad('rol/rolUpd.php?rol_id=' + rol_id);
	}
	function rol_borrar(rol_id) {
		if (confirm("¿Borrar rol?")) {
			$.post('rol/proceso/rol_borrar.php', {
				rol_id: rol_id
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
	function rol_activar(rol_id) {
		if (confirm("¿Activar rol?")) {
			$.post('rol/proceso/rol_activar.php', {
				rol_id: rol_id
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
