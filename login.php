<?php
//Conexión a la db
require 'includes/app.php';
$db = conectarDB();

//Arreglo de errores
$errores = [];

//Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //Validando
    if (!$email) {
        $errores[] = 'El email es obligatorio';
    }

    if (!$password) {
        $errores[] = 'El password es obligatorio';
    }

    if (empty($errores)) {
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '$email';";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            //Verificar si el password coincide
            $auth = password_verify($password, $usuario['password']);

            if ($auth) {
                //Usuario autenticado
                session_start();

                //Llenar arreglo de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                //Redireccionar
                header('Location: /admin');
            } else {
                $errores[] = 'Contraseña incorrecta';
            }
        } else {
            $errores[] = 'El usuario no existe';
        }
    }
}

//Incluye el header
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <p class="alerta error"><?php echo $error; ?></p>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>E-mail y Password</legend>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="mail@mail.com">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password">
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>