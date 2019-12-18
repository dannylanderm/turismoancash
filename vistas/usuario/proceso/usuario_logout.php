<?php
    include_once '../../../includes/Usuario_Session.php';

    $usuarioSession = new UsuarioSession();
    $usuarioSession->closeSession();

    header("location: ../../../index.php");