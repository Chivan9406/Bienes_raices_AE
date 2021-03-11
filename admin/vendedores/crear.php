<?php
//Sesión
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

// Primer instancia de la clase Objeto para el formulario
$vendedor = new Vendedor();

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

/** Super Globales  **/
//Se ejecuta después de enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Instancia de Vendedor
    $vendedor = new Vendedor($_POST['vendedor']);

    //Validar
    $errores = $vendedor->validar();

    //Revisar que el arreglo de errores este vacio
    if (empty($errores)) {
        // Guarda en la BD
        $vendedor->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>

    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/crear.php">

        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>