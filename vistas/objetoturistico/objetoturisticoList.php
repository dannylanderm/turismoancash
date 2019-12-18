<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/objetoturisticoDAL.php';
	$obj_dal = new objetoturisticoDAL();
	$b = GetStringParam('b');
	$obj_list = $obj_dal->listar($b);
?>
<table id='tblobjetoturistico' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Tipo de objeto turístico</th>
		<th>Foto</th>
		<th>Comentario</th>
		<th>Fecha datacion</th>
		<th>Lugar turístico</th>
		<th>Situacion</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($obj_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['obj_id']); ?></td>
		<td><?php echo $row['obj_nombre']; ?></td>
		<td><?php echo $row['tipoobj_nombre']; ?></td>
		<td><?php echo $row['obj_foto']; ?></td>
		<td><?php echo $row['obj_comentario']; ?></td>
		<td class='txt_center'><?php echo formatDate($row['obj_fecha_datacion']); ?></td>
		<td><?php echo $row['lug_nombre']; ?></td>
		<td><?php echo $row['obj_situacion']; ?></td>
		<td hidden><?php echo $row['obj_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="obj_editar('<?php echo $row['obj_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="obj_borrar('<?php echo $row['obj_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function obj_editar(obj_id) {
		performLoad('objetoturistico/objetoturisticoUpd.php?obj_id=' + obj_id);
	}
	function obj_borrar(obj_id) {
		if (confirm("¿Borrar objeto turístico?")) {
			$.post('objetoturistico/proceso/objetoturistico_borrar.php', {
				obj_id: obj_id
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
	function obj_activar(obj_id) {
		if (confirm("¿Activar objeto turístico?")) {
			$.post('objetoturistico/proceso/objetoturistico_activar.php', {
				obj_id: obj_id
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