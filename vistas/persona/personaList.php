<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	
	CheckLoginAccess();

	include_once '../../includes/personaDAL.php';
	$pers_dal = new personaDAL();
	$b = GetStringParam('b');
	$pers_list = $pers_dal->listar($b);
?>
<table id='tblpersona' class='table table-responsive'>
	<tr>
		<th>ID</th>
		<th>Ap paterno</th>
		<th>Ap materno</th>
		<th>Nombres</th>
		<th>Correo</th>
		<th hidden>Estado</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
	<?php foreach($pers_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['pers_id']); ?></td>
		<td><?php echo $row['pers_ap_paterno']; ?></td>
		<td><?php echo $row['pers_ap_materno']; ?></td>
		<td><?php echo $row['pers_nombres']; ?></td>
		<td><?php echo $row['pers_correo']; ?></td>
		<td hidden><?php echo $row['pers_estado']; ?></td>
		<td class='txt_center'><a href='#' class='btn btn-info' onclick="pers_editar('<?php echo $row['pers_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td class='txt_center'><a href='#'  class='btn btn-danger' onclick="pers_borrar('<?php echo $row['pers_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function pers_editar(pers_id) {
		performLoad('persona/personaUpd.php?pers_id=' + pers_id);
	}
	function pers_borrar(pers_id) {
		if (confirm("¿Borrar persona?")) {
			$.post('persona/proceso/persona_borrar.php', {
				pers_id: pers_id
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
	function pers_activar(pers_id) {
		if (confirm("¿Activar persona?")) {
			$.post('persona/proceso/persona_activar.php', {
				pers_id: pers_id
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