<?php

    class UsuarioSession
    {
        function __construct() {
            if (!isset($_SESSION)) {
                session_start();
            }
        }

        public function setCurrentUsuario($login) {
            $_SESSION['login'] = $login;
        }

        public function getCurrentUsuario() {
            return $_SESSION['login'];
        }

        public function setCurrentNombreUsu($nomUsuario) {
            $_SESSION['nomUsuario'] = $nomUsuario;
        }

        public function getCurrentNombreUsu() {
            return $_SESSION['nomUsuario'];
        }

        public function closeSession() {
            session_unset();
            session_destroy();
        }
    }
