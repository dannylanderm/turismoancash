<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/usuarioDAL.php';
	$usu_dal = new usuarioDAL();
	$b = GetStringParam('b');
	$usu_list = $usu_dal->listar($b);
?>
<table id='tblusuario' class='table table-responsive txt_left'>
	<tr>
		<th>ID</th>
		<th>Persona</th>
		<th>Nombre</th>
		<th>Rol</th>
		<th>Fecha acceso</th>
		<th hidden>Registrado</th>
		<th hidden>Estado</th>
		<th hidden>Editar</th>
		<th hidden>Borrar</th>
	</tr>
	<?php foreach($usu_list as $row) { ?>
	<tr>
		<td class='txt_center'><?php echo pad($row['usu_id']); ?></td>
		<td><?php echo $row['pers_nombres']; ?></td>
		<td><?php echo $row['usu_nombre']; ?></td>
		<td><?php echo $row['rol_nombre']; ?></td>
		<td class='txt_center'><?php echo formatDate($row['usu_fecha_acceso']); ?></td>
		<td class='txt_center' hidden><?php echo $row['usu_fecha_reg']; ?></td>
		<td hidden><?php echo $row['usu_estado']; ?></td>
		<td hidden class='txt_center'><a href='#' class='btn btn-info' onclick="usu_editar('<?php echo $row['usu_id']; ?>');"><img src='../resources/img/edit.png' style='width: 16px;'></a></td>
		<td hidden class='txt_center'><a href='#'  class='btn btn-danger' onclick="usu_borrar('<?php echo $row['usu_id']; ?>');"><img src='../resources/img/delete.png' style='width: 16px;'></a></td>
	</tr>
	<?php } ?>
</table>
<script>
	function usu_editar(usu_id) {
		performLoad('usuario/usuarioUpd.php?usu_id=' + usu_id);
	}
	function usu_borrar(usu_id) {
		if (confirm("¿Borrar usuario?")) {
			$.post('usuario/proceso/usuario_borrar.php', {
				usu_id: usu_id
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
	function usu_activar(usu_id) {
		if (confirm("¿Activar usuario?")) {
			$.post('usuario/proceso/usuario_activar.php', {
				usu_id: usu_id
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