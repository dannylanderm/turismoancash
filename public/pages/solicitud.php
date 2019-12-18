<?php
    session_start();
    include_once '../../includes/AppUtils.php';

    include_once '../../includes/clienteDAL.php';
    $cli_dal = new clienteDAL();

    include_once '../../includes/servicioDAL.php';
    $serv_dal = new servicioDAL();

    $serv_id = isset($_GET['serv_id']) ? $_GET['serv_id'] : 0;
?>
<div class='centered'>
    <section id="contact_form">
        <form id='frmMensajeReg' method='post'>
            <div class='regform'>
                <div class='regform_body'>
                    <div class='txt_center'>
                        <span class='h2 rojo'>Registra tu solicitud</span>
                    </div>
                    <hr class='separator'/>
                    <table style="margin:auto;">
                        <tr>
                            <td><label for='txtCliNombres'>Nombres:</label></td>
                            <td><input type='text' class='form-control inline txt300' id='txtCliNombres'
                                       name='txtCliNombres' maxlength='50'
                                       placeholder='Ingrese nombres'/></td>
                        </tr>
                        <tr>
                            <td><label for='txtCliApellidos'>Apellidos:</label></td>
                            <td><input type='text' class='form-control inline txt300' id='txtCliApellidos'
                                       name='txtCliApellidos' maxlength='50'
                                       placeholder='Ingrese apellidos'/></td>
                        </tr>
                        <tr>
                            <td><label for='txtCliEmail'>Email:</label></td>
                            <td><input type='text' class='form-control inline txt300' id='txtCliEmail'
                                       name='txtCliEmail' maxlength='50'
                                       placeholder='Ingrese email'/></td>
                        </tr>
                        <tr>
                            <td><label for='txtCliTelefono'>Telefono:</label></td>
                            <td><input type='text' class='form-control inline txt300' id='txtCliTelefono'
                                       name='txtCliTelefono' maxlength='50'
                                       placeholder='Ingrese telefono'/></td>
                        </tr>
                        <tr>
                            <td><label for='txtCliDireccion'>Direccion:</label></td>
                            <td><input type='text' class='form-control inline txt300' id='txtCliDireccion'
                                       name='txtCliDireccion' maxlength='200'
                                       placeholder='Ingrese direccion'/></td>
                        </tr>
                        <tr>
                            <td><label for='txtMsgServID'>Servicio:</label></td>
                            <td><select id='txtMsgServID' name='txtMsgServID' class='form-control'>
                                    <!-- maxlength='10' -->
                                    <option value='0'>(Seleccione)</option>
                                    <?php $serv_list = $serv_dal->listarServicio('');  foreach ($serv_list as $row) { ?>
                                        <option value='<?php echo $row['serv_id']; ?>'
                                            <?php echo ($serv_id == $row['serv_id']) ? 'selected' : ''; ?>>
                                            <?php echo $row['serv_nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for='txtMsgMensaje'>Mensaje:</label></td>
                            <td><textarea id='txtMsgMensaje' name='txtMsgMensaje' maxlength='300' rows='5' cols='60'
                                          class='form-control' placeholder='Ingrese mensaje'></textarea>
                        </tr>
                        <tr hidden>
                            <td><label for='txtMsgSituacion'>Situacion:</label></td>
                            <td><input type='text' class='form-control inline txt300' id='txtMsgSituacion'
                                       name='txtMsgSituacion' maxlength='1'
                                       placeholder='Ingrese situacion'/></td>
                        </tr>
                        <tr hidden>
                            <td><label for='txtMsgFechaAtencion'>Fecha atencion:</label></td>
                            <td><input type='text' class='form-control inline txt300' id='txtMsgFechaAtencion'
                                       name='txtMsgFechaAtencion'
                                       placeholder='Ingrese fecha atencion'/></td>
                        </tr>
                    </table>
                    <hr class='separator'/>
                    <div class='txt_center'>
                        <input class='btn btn-primary' type='button' name='btnRegistrar' id='btnRegistrar'
                               value='Registrar pedido'/>
                        <a class='btn btn-default' href='index.php'>Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script>
        var msg_reg = '#frmMensajeReg';
        $(document).ready(function (e) {
            $(msg_reg).find('#txtMsgCliID').focus();
            $(msg_reg).find('#btnRegistrar').off('click').click(function (e) {
                if (msg_validar()) {
                    var cli_apellidos      = $(msg_reg).find('#txtCliApellidos').val();
                    var cli_nombres        = $(msg_reg).find('#txtCliNombres').val();
                    var cli_email          = $(msg_reg).find('#txtCliEmail').val();
                    var cli_telefono       = $(msg_reg).find('#txtCliTelefono').val();
                    var cli_direccion      = $(msg_reg).find('#txtCliDireccion').val();
                    var msg_serv_id        = $(msg_reg).find('#txtMsgServID').val();
                    var msg_mensaje        = $(msg_reg).find('#txtMsgMensaje').val();
                    var msg_situacion      = $(msg_reg).find('#txtMsgSituacion').val();
                    var msg_fecha_atencion = getDateYMD($(msg_reg).find('#txtMsgFechaAtencion').val());

                    $.post('mensaje/proceso/mensaje_insert.php', {
                            cli_apellidos     : cli_apellidos,
                            cli_nombres       : cli_nombres,
                            cli_email         : cli_email,
                            cli_telefono      : cli_telefono,
                            cli_direccion     : cli_direccion,
                            msg_serv_id       : msg_serv_id,
                            msg_mensaje       : msg_mensaje,
                            msg_situacion     : msg_situacion,
                            msg_fecha_atencion: msg_fecha_atencion
                        },
                        function (datos) {
                            if (datos > 0) {
                                alert('Registro correcto, tu pedido se ha procesado, en breve nos comunicaremos contigo.');

                                volver();
                            } else {
                                alert('Error al registrar. ' + datos);
                            }
                        });
                }
            });
            $(msg_reg).find('#btnCancelar').click(function (e) {
                volver();
            });
        });

        function msg_validar() {
            var cli_apellidos      = $(msg_reg).find('#txtCliApellidos').val();
            var cli_nombres        = $(msg_reg).find('#txtCliNombres').val();
            var cli_email          = $(msg_reg).find('#txtCliEmail').val();
            var cli_telefono       = $(msg_reg).find('#txtCliTelefono').val();
            var cli_direccion      = $(msg_reg).find('#txtCliDireccion').val();
            var msg_serv_id        = $(msg_reg).find('#txtMsgServID').val();
            var msg_mensaje        = $(msg_reg).find('#txtMsgMensaje').val();
            var msg_situacion      = $(msg_reg).find('#txtMsgSituacion').val();
            var msg_fecha_atencion = $(msg_reg).find('#txtMsgFechaAtencion').val();

            if (cli_nombres == '') {
                alert('Ingrese nombre válido de cliente', 'txtCliNombres');
                return false;
            }
            if (!validNombre(cli_nombres)) {
                alert('Ingrese nombre válido de cliente', 'txtCliNombres');
                return false;
            }
            if (cli_apellidos == '') {
                alert('Ingrese apellidos válidos', 'txtCliApellidos');
                return false;
            }
            if (!validNombre(cli_apellidos)) {
                alert('Ingrese apellidos válidos', 'txtCliApellidos');
                return false;
            }
            if (!isEmail(cli_email)) {
                alert('Ingrese valor de email válido', 'txtCliEmail');
                return false;
            }
            if (cli_telefono == '') {
                alert('Ingrese un telefono válido', 'txtCliTelefono');
                return false;
            }
            if (!validTelefono(cli_telefono)) {
                alert('Ingrese un telefono válido', 'txtCliTelefono');
                return false;
            }
            if (cli_direccion == '') {
                alert('Ingrese una direccion válida', 'txtCliDireccion');
                return false;
            }
            if (!validDireccion(cli_direccion)) {
                alert('Ingrese una direccion válida', 'txtCliDireccion');
                return false;
            }
            if (!(isInteger(msg_serv_id) && msg_serv_id > 0)) {
                alert('Seleccione servicio', 'txtMsgServID');
                return false;
            }
            if (msg_mensaje == '') {
                alert('Ingrese un mensaje válido', 'txtMsgMensaje');
                return false;
            }
            if (msg_situacion == '') {
                // alert('Ingrese situacion', 'txtMsgSituacion');
                // return false;
            }
            if (!isDate(msg_fecha_atencion)) {
                // alert('Ingrese una fecha de atencion válida', 'txtMsgFechaAtencion');
                // return false;
            }
            return true;
        }

        function volver() {
            window.location = 'index.php';
        }

    </script>
</div>