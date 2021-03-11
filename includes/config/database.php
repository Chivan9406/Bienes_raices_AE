<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'root', 'root', 'bienes_raices');

    if (!$db) {
        echo 'Error en la conexión';
        exit;
    }

    return $db;
}
