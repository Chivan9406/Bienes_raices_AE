<?php

use App\Vendedor;

require '../../includes/app.php';

estaAutenticado();

//Obtener el id de la url
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

//Si no existe el id
if (!$id) {
    header('Location: /admin');
}

//Obtener los datos del vendedor
$vendedor = Vendedor::find($id);

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

//Se ejecuta después de enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los atributos
    $args = $_POST['vendedor'];

    $vendedor->sincronizar($args);

    // Validación
    $errores = $vendedor->validar();

    //Revisar que el arreglo de errores este vacio
    if (empty($errores)) {
        $resultado = $vendedor->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>