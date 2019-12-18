<?php
	session_start();
	include_once '../../includes/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('catlug_reg', 'categorialugar/categorialugar.php');
?>
<form id='frmCategorialugarReg' method='post'>
    <div class='regform'>
        <div class='regform_body'>
            <div class='form_title'>
                <span class='h2'>Registrar categoría de lugar</span>
            </div>
            <hr class='separator'/>
            <table class='form_data'>
                <tr>
                    <td><label for='txtCatlugNombre'>Nombre:</label></td>
                    <td><input type='text' class='form-control txt250' id='txtCatlugNombre' name='txtCatlugNombre'
                               maxlength='50' placeholder='Ingrese nombre'/></td>
                </tr>
                <tr>
                    <td><label for='txtCatlugDescripcion'>Descripcion:</label></td>
                    <td><textarea id='txtCatlugDescripcion' name='txtCatlugDescripcion' maxlength='400' rows='5'
                                  class='form-control txt320' placeholder='Ingrese descripcion'></textarea>
                </tr>
            </table>
            <hr class='separator'/>
            <div class='form_foot'>
                <input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
                <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
            </div>
        </div>
    </div>
</form>
<br/>
<script>
    var catlug_reg = '#frmCategorialugarReg';
    $(document).ready(function (e) {
        $(catlug_reg).find('#txtCatlugNombre').focus();
        $(catlug_reg).find('#btnRegistrar').off('click').click(function (e) {
            if (catlug_validar()) {
                var catlug_nombre      = $(catlug_reg).find('#txtCatlugNombre').val();
                var catlug_descripcion = $(catlug_reg).find('#txtCatlugDescripcion').val();

                $.post('categorialugar/proceso/categorialugar_insert.php', {
                        catlug_nombre     : catlug_nombre,
                        catlug_descripcion: catlug_descripcion
                    },
                    function (datos) {
                        if (datos > 0) {
                            alert('Registro correcto');
                            volver();
                        } else {
                            alert('Error al registrar. ' + datos);
                        }
                    });
            }
        });
        $(catlug_reg).find('#btnCancelar').click(function (e) {
            volver();
        });
    });

    function catlug_validar() {
        var catlug_nombre      = $(catlug_reg).find('#txtCatlugNombre').val();
        var catlug_descripcion = $(catlug_reg).find('#txtCatlugDescripcion').val();

        if (catlug_nombre == '') {
            alert('Ingrese un nombre válido para la categoría de lugar');
            return false;
        }
        if (catlug_descripcion == '') {
            alert('Ingrese una descripcion válida');
            return false;
        }
        return true;
    }

    function volver() {
        performLoad('<?php echo $parent; ?>');
    }
</script>