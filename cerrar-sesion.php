<?php
session_start();

//Reiniciar el arreglo de _session
$_SESSION = [];

header('Location: /');