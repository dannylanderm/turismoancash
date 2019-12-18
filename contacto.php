<!DOCTYPE html>
<html lang="es">
<?php include_once 'public/common/head.php' ?>
<body>
<div id='menu'></div>
<div id='contenido'></div>
<div id='footer'></div>
</body>
</html>
<script>
    $('#menu').load('public/common/menu.php');
    $('#contenido').load('public/pages/contacto.php');
    $('#footer').load('public/common/footer.php');
</script>