<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../includes/actividadesDAL.php';
	$activ_dal  = new actividadesDAL();
	$lugar      = GetStringParam('lugar');
	$b          = GetStringParam('b');
	$activ_list = $activ_dal->listarByLugar($lugar, $b);
?>
<table id='tblactividades' class='table table-responsive txt_left'>
    <tr>
        <th>Lugar turístico</th>
        <th>Tipo de actividad</th>
        <th hidden>Situacion</th>
        <th hidden >Editar</th>
        <th>Borrar</th>
    </tr>
	<?php foreach ($activ_list as $row) { ?>
        <tr>
            <td><?php echo pad($row['lug_nombre']); ?></td>
            <td><?php echo pad($row['tipoactiv_nombre']); ?></td>
            <td hidden><?php echo $row['activ_situacion']; ?></td>
            <td hidden class='txt_center'>
                <a href='#' class='btn btn-info'
                   onclick="activ_editar('<?php echo $row['lug_id']; ?>', '<?php echo $row['tipoactiv_id']; ?>');">
                    <img src='../resources/img/edit.png' style='width: 16px;'>
                </a>
            </td>
            <td class='txt_center'>
                <a href='#' class='btn btn-danger'
                   onclick="activ_borrar('<?php echo $row['lug_id']; ?>', '<?php echo $row['tipoactiv_id']; ?>');">
                    <img src='../resources/img/delete.png' style='width: 16px;'>
                </a>
            </td>
        </tr>
	<?php } ?>
</table>
<script>
    function activ_editar(activ_lug_id, activ_tipoactiv_id) {
        performLoad('actividades/actividadesUpd.php?activ_lug_id=' + activ_lug_id + '&activ_tipoactiv_id=' + activ_tipoactiv_id);
    }

    function activ_borrar(activ_lug_id, activ_tipoactiv_id) {
        if (confirm("¿Borrar actividad?")) {
            $.post('actividades/proceso/actividades_borrar.php', {
                    activ_lug_id      : activ_lug_id,
                    activ_tipoactiv_id: activ_tipoactiv_id
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

    function activ_activar(activ_lug_id, activ_tipoactiv_id) {
        if (confirm("¿Activar actividad?")) {
            $.post('actividades/proceso/actividades_activar.php', {
                    activ_lug_id      : activ_lug_id,
                    activ_tipoactiv_id: activ_tipoactiv_id
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
