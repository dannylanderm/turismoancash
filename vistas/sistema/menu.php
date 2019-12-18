<nav class="navbar navbar-inverse ">
<div class="container">

<div id='btnInicio' style='display: inline-block; cursor: pointer;' class="navbar-header"
     onclick='performLoad("usuario/bienvenido.php")'>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" style='padding-top: 10px;margin: 0 !important;'>
        <img class="logo" src="../resources/images/logo_sm.png" style='height: 40px;width: 40px;' alt="">
    </a>
    <a class="navbar-brand" href="#"> Turismo<br> Ancash</a>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lugares
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href='#' onclick="load('categorialugar');">Categoría Lugar</a></li>
                <li><a href='#' onclick="load('tipolugar');">Tipo de lugar</a></li>
                <li><a href='#' onclick="load('lugarturistico');">Lugares turisticos</a></li>
                <li><a href='#' onclick="load('tipoobjetoturistico');">Tipo de objetos turisticos</a></li>
                <li><a href='#' onclick="load('objetoturistico');">Objetos turisticos</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actividades
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href='#' onclick="load('tipoactividad');">Tipo de actividad</a></li>
                <li><a href='#' onclick="load('actividades');">Actividades</a></li>
                <li><a href='#' onclick="load('tiporecomendacion');">Tipo de recomendación</a></li>
                <li><a href='#' onclick="load('recomendacion');">Recomendaciones</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cercanías
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href='#' onclick="load('tipositio');">Tipo de sitio</a></li>
                <li><a href='#' onclick="load('sitio');">Sitios cercanos</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Seguridad
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="load('usuario');">Usuarios</a></li>
                <li><a href="#" onclick="load('persona');">Personal</a></li>
                <li><a href="#" onclick="load('rol');">Roles</a></li>
            </ul>
        </li>
    </ul>
    <form class="navbar-form navbar-left">
    </form>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="../vistas/usuario/proceso/usuario_logout.php">Desconectar</a></li>
    </ul>
</div>
</div>
</nav>

