<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/lugarturisticoDAL.php';
	$lug_dal = new lugarturisticoDAL();
	$b = GetStringParam('b');
	$lug_list = $lug_dal->listar($b);
?>
<table id='tbllugarturistico' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Tipo de lugar</th>
		<th>Latitud geo</th>
		<th>Longitud geo</th>
		<th>Altitud</th>
		<th>Tamanio area</th>
		<th>Foto</th>
		<th>Descripcion</th>
		<th>Ubigeo</th>
		<th>Direccion ref</th>
		<th>Tipo de ingreso</th>
		<th>Calificacion</th>
		<th>Situacion</th>
		<th>Resenia</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($lug_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['lug_id']); ?></td>
		<td><?php echo $row['lug_nombre']; ?></td>
		<td><?php echo $row['tipolug_nombre']; ?></td>
		<td class='txt_right'> <?php echo $row['lug_latitud_geo']; ?></td>
		<td class='txt_right'> <?php echo $row['lug_longitud_geo']; ?></td>
		<td class='txt_right'> <?php echo $row['lug_altitud']; ?></td>
		<td class='txt_right'> <?php echo $row['lug_tamanio_area']; ?></td>
		<td><?php echo $row['lug_foto']; ?></td>
		<td><?php echo $row['lug_descripcion']; ?></td>
		<td><?php echo $row['ubig_nombre']; ?></td>
		<td><?php echo $row['lug_direccion_ref']; ?></td>
		<td><?php echo $row['tipoing_nombre']; ?></td>
		<td><?php echo $row['lug_calificacion']; ?></td>
		<td><?php echo $row['lug_situacion']; ?></td>
		<td><?php echo $row['lug_resenia']; ?></td>
		<td class='txt_center' hidden><?php echo $row['lug_fecha_reg']; ?></td>
		<td hidden><?php echo $row['lug_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="lug_editar('<?php echo $row['lug_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="lug_borrar('<?php echo $row['lug_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<hr>
<script>
	function lug_editar(lug_id) {
		performLoad('lugarturistico/lugarturisticoUpd.php?lug_id=' + lug_id);
	}
	function lug_borrar(lug_id) {
		if (confirm("¿Borrar lugar turístico?")) {
			$.post('lugarturistico/proceso/lugarturistico_borrar.php', {
				lug_id: lug_id
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
	function lug_activar(lug_id) {
		if (confirm("¿Activar lugar turístico?")) {
			$.post('lugarturistico/proceso/lugarturistico_activar.php', {
				lug_id: lug_id
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