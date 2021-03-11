<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

estaAutenticado();

//Obtener el id de la url
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

//Si no existe el id
if (!$id) {
    header('Location: /admin');
}

//Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultadoConsulta = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

//Se ejecuta después de enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    // Subir imagen
    //Generar un nombre único de la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Set de imagen
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        //Realiza un resize a la imagen con intervention
        $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);

        // Guarda la imagen en el servidor
        $imagen->save(CARPETA_IMAGENES . $nombreImagen);
    }

    // Validación
    $errores = $propiedad->validar();

    //Revisar que el arreglo de errores este vacio
    if (empty($errores)) {

        $resultado = $propiedad->guardar();
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

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>