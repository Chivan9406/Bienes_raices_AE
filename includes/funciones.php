<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado()
{
    //Sesión
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

function debuggear($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

// Escapa el HTML
function sanitizar($html): string
{
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}
