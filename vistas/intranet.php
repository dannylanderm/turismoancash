<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Turismo Ancash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../resources/custom-font/fonts.css"/>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../resources/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../resources/css/bootsnav.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/jquery.fancybox.css?v=2.1.5" media="screen"/>
    <link rel="stylesheet" href="../resources/css/custom.css"/>
    <link rel="stylesheet" href="../resources/css/styles.datepicker.css"/>
    <!--[if lt IE 9]>
    <script src="../resources/js/html5.min.js"></script>
    <![endif]-->
    <link rel='icon' type='image/png' sizes='16x16' href='../favicon.ico'>

    <script src="../resources/js/jquery-1.12.1.min.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>
    <script src="../resources/js/bootsnav.js"></script>
    <script src="../resources/js/isotope.js"></script>
    <script src="../resources/js/isotope-active.js"></script>
    <script src="../resources/js/jquery.fancybox.js?v=2.1.5"></script>
    <script src="../resources/js/jquery.scrollUp.min.js"></script>
    <script src="../resources/js/main.js"></script>
    <script src="../resources/js/utils.js"></script>
    <script src="../resources/js/jquery-ui.min.js"></script>
</head>
<body>
<div id='menu'></div>
<div id='contenido'></div>
</body>
<script>
    $('#menu').load('sistema/menu.php');
    $('#contenido').load('usuario/bienvenido.php');

    // >> Carga de paginas
    function load(pagina) {
        performLoad(pagina + '/' + pagina + '.php');
    }

    function loadOn(module, pagina) {
        performLoad(module + '/' + pagina + '.php');
    }

    function performLoad(contenido) {
        $('#contenido').load(contenido);
    }
</script>

