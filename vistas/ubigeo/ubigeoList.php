<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
	$b = GetStringParam('b');
	$ubig_list = $ubig_dal->listar($b);
?>
<table id='tblubigeo' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Codigo</th>
		<th>Dpto cod</th>
		<th>Prov cod</th>
		<th>Dist cod</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($ubig_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['ubig_id']); ?></td>
		<td class='txt_center'><?php echo $row['ubig_codigo']; ?></td>
		<td><?php echo $row['ubig_dpto_cod']; ?></td>
		<td><?php echo $row['ubig_prov_cod']; ?></td>
		<td><?php echo $row['ubig_dist_cod']; ?></td>
		<td><?php echo $row['ubig_nombre']; ?></td>
		<td hidden><?php echo $row['ubig_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="ubig_editar('<?php echo $row['ubig_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="ubig_borrar('<?php echo $row['ubig_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function ubig_editar(ubig_id) {
		performLoad('ubigeo/ubigeoUpd.php?ubig_id=' + ubig_id);
	}
	function ubig_borrar(ubig_id) {
		if (confirm("¿Borrar ubigeo?")) {
			$.post('ubigeo/proceso/ubigeo_borrar.php', {
				ubig_id: ubig_id
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
	function ubig_activar(ubig_id) {
		if (confirm("¿Activar ubigeo?")) {
			$.post('ubigeo/proceso/ubigeo_activar.php', {
				ubig_id: ubig_id
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