<?php
    session_start();
?>
<div class='txt_center'>
    <h2>Bienvenido</h2>
    <h3><?= $_SESSION['auth.usu_nombres'], ' ', $_SESSION['auth.usu_ap_paterno'], ' ', $_SESSION['auth.usu_ap_materno'] ?></h3>
    <img src='../resources/images/user.png' style='width: 200px;' alt=''>
</div>
