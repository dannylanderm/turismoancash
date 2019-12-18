<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php

?>
<div id='frmActividades' class='txt_center'>
    <div class='form_top'>
        <span class='h1'>Actividades</span>
        <hr class='separator'/>
        <div>
            <label for='txtBuscar'>Lugar:</label>
            <input type='text' class='form-control txt250 inline' id='txtLugar' name='txtLugar'
                   placeholder='Nombre del lugar'/>
            &nbsp;<label for='txtBuscar'>Actividad:</label>
            <input type='text' class='form-control txt250 inline' id='txtBuscar' name='txtBuscar'
                   placeholder='Nombre de la actividad'/>
            <a href='#' class='btn btn-default' id='btnRefrescar' name='btnRefrescar'>
                <img class='icon' src='../resources/img/refresh.png'>
            </a>
            <a href='#' class='btn btn-default' id='btnNuevo' name='btnNuevo'>Nuevo</a>
        </div>
    </div>
    <hr class='separator'/>
    <div class='listform_body bpad15'>
        <div id='datos' class='centered'></div>
    </div>
</div>
<script>
    var frm_activ = '#frmActividades';
    $(document).ready(function (e) {
        activ_mostrarDatos();
        $(frm_activ).find('#txtBuscar').focus();
        $(frm_activ).find('#txtLugar').keyup(function (e) {
            activ_mostrarDatos();
        });
        $(frm_activ).find('#txtBuscar').keyup(function (e) {
            activ_mostrarDatos();
        });
        $(frm_activ).find('#btnNuevo').off('click').click(function (e) {
            performLoad('actividades/actividadesReg.php?parent=actividades/actividades.php');
        });
        $(frm_activ).find('#btnRefrescar').off('click').click(function (e) {
            activ_mostrarDatos();
        });
    });

    function activ_mostrarDatos() {
        var lugar  = encodeURIComponent($('#txtLugar').val());
        var buscar = encodeURIComponent($('#txtBuscar').val());
        $(frm_activ).find('#datos').load('actividades/actividadesList.php?lugar=' + lugar + '&b=' + buscar);
    }

    function volver() {
        performLoad('actividades/actividades.php');
    }
</script>
