<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/calendariovisitaDAL.php';
	$calend_dal = new calendariovisitaDAL();
	$b = GetStringParam('b');
	$calend_list = $calend_dal->listar($b);
?>
<table id='tblcalendariovisita' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Lugar turístico</th>
		<th>Nro</th>
		<th>Fecha ini</th>
		<th>Fecha fin</th>
		<th>Hora ini</th>
		<th>Hora fin</th>
		<th>Situacion</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($calend_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['calend_id']); ?></td>
		<td><?php echo $row['lug_nombre']; ?></td>
		<td><?php echo $row['calend_nro']; ?></td>
		<td class='txt_center'><?php echo formatDate($row['calend_fecha_ini']); ?></td>
		<td class='txt_center'><?php echo formatDate($row['calend_fecha_fin']); ?></td>
		<td><?php echo $row['calend_hora_ini']; ?></td>
		<td><?php echo $row['calend_hora_fin']; ?></td>
		<td><?php echo $row['calend_situacion']; ?></td>
		<td hidden><?php echo $row['calend_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="calend_editar('<?php echo $row['calend_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="calend_borrar('<?php echo $row['calend_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function calend_editar(calend_id) {
		performLoad('calendariovisita/calendariovisitaUpd.php?calend_id=' + calend_id);
	}
	function calend_borrar(calend_id) {
		if (confirm("¿Borrar calendario de visita?")) {
			$.post('calendariovisita/proceso/calendariovisita_borrar.php', {
				calend_id: calend_id
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
	function calend_activar(calend_id) {
		if (confirm("¿Activar calendario de visita?")) {
			$.post('calendariovisita/proceso/calendariovisita_activar.php', {
				calend_id: calend_id
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