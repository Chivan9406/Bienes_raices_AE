<?php

//Importar la conexión
require 'includes/config/database.php';
$db = conectarDB();

//Crear e-mail y password
$email = "correo@correo.com";
$password = "123456";

//Hashear el password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

//Agregarlo a la BD
mysqli_query($db, $query);