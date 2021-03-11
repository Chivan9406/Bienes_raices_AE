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

// Validar tipo de contenido
function validarTipoContenido ($tipo) {
    $tipos = ['propiedad', 'vendedor'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;

        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;

        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}