<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/tipoobjetoturisticoDAL.php';
	$tipoobj_dal = new tipoobjetoturisticoDAL();
	$b = GetStringParam('b');
	$tipoobj_list = $tipoobj_dal->listar($b);
?>
<table id='tbltipoobjetoturistico' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($tipoobj_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['tipoobj_id']); ?></td>
		<td><?php echo $row['tipoobj_nombre']; ?></td>
		<td hidden><?php echo $row['tipoobj_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="tipoobj_editar('<?php echo $row['tipoobj_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="tipoobj_borrar('<?php echo $row['tipoobj_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function tipoobj_editar(tipoobj_id) {
		performLoad('tipoobjetoturistico/tipoobjetoturisticoUpd.php?tipoobj_id=' + tipoobj_id);
	}
	function tipoobj_borrar(tipoobj_id) {
		if (confirm("¿Borrar tipo de objeto turístico?")) {
			$.post('tipoobjetoturistico/proceso/tipoobjetoturistico_borrar.php', {
				tipoobj_id: tipoobj_id
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
	function tipoobj_activar(tipoobj_id) {
		if (confirm("¿Activar tipo de objeto turístico?")) {
			$.post('tipoobjetoturistico/proceso/tipoobjetoturistico_activar.php', {
				tipoobj_id: tipoobj_id
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