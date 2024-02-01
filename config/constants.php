<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    define('base_url', 'http://localhost/university__projects/the__blossom/');
    define('controller_default', 'ProductoController');
    define('action_default', 'index');
    define('imagen_defecto','http://localhost/university__projects/the__blossom/assets/img/imagen-defecto.png');
?>