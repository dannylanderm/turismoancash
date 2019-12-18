<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/sitioDAL.php';
	$sitio_dal = new sitioDAL();
	$b = GetStringParam('b');
	$sitio_list = $sitio_dal->listar($b);
?>
<table id='tblsitio' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Tipo de sitio</th>
		<th>Latitud geo</th>
		<th>Longitud geo</th>
		<th>Celular</th>
		<th>Telefono</th>
		<th>Webpage</th>
		<th>Ubigeo</th>
		<th>Direccion</th>
		<th>Calificacion</th>
		<th>Situacion</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($sitio_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['sitio_id']); ?></td>
		<td><?php echo $row['sitio_nombre']; ?></td>
		<td><?php echo $row['tipositio_nombre']; ?></td>
		<td class='txt_right'> <?php echo $row['sitio_latitud_geo']; ?></td>
		<td class='txt_right'> <?php echo $row['sitio_longitud_geo']; ?></td>
		<td><?php echo $row['sitio_celular']; ?></td>
		<td><?php echo $row['sitio_telefono']; ?></td>
		<td><?php echo $row['sitio_webpage']; ?></td>
		<td><?php echo $row['ubig_nombre']; ?></td>
		<td><?php echo $row['sitio_direccion']; ?></td>
		<td><?php echo $row['sitio_calificacion']; ?></td>
		<td><?php echo $row['sitio_situacion']; ?></td>
		<td hidden><?php echo $row['sitio_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="sitio_editar('<?php echo $row['sitio_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="sitio_borrar('<?php echo $row['sitio_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function sitio_editar(sitio_id) {
		performLoad('sitio/sitioUpd.php?sitio_id=' + sitio_id);
	}
	function sitio_borrar(sitio_id) {
		if (confirm("¿Borrar sitio?")) {
			$.post('sitio/proceso/sitio_borrar.php', {
				sitio_id: sitio_id
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
	function sitio_activar(sitio_id) {
		if (confirm("¿Activar sitio?")) {
			$.post('sitio/proceso/sitio_activar.php', {
				sitio_id: sitio_id
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