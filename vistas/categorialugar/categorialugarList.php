<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/categorialugarDAL.php';
	$catlug_dal = new categorialugarDAL();
	$b = GetStringParam('b');
	$catlug_list = $catlug_dal->listar($b);
?>
<table id='tblcategorialugar' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Descripcion</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($catlug_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['catlug_id']); ?></td>
		<td class='bold'><?php echo $row['catlug_nombre']; ?></td>
		<td><?php echo $row['catlug_descripcion']; ?></td>
		<td hidden><?php echo $row['catlug_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="catlug_editar('<?php echo $row['catlug_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="catlug_borrar('<?php echo $row['catlug_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<hr>
<script>
	function catlug_editar(catlug_id) {
		performLoad('categorialugar/categorialugarUpd.php?catlug_id=' + catlug_id);
	}
	function catlug_borrar(catlug_id) {
		if (confirm("¿Borrar categoría de lugar?")) {
			$.post('categorialugar/proceso/categorialugar_borrar.php', {
				catlug_id: catlug_id
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
	function catlug_activar(catlug_id) {
		if (confirm("¿Activar categoría de lugar?")) {
			$.post('categorialugar/proceso/categorialugar_activar.php', {
				catlug_id: catlug_id
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