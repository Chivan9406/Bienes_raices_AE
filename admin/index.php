<?php
//Sesión
require '../includes/app.php';

estaAutenticado();

use App\Propiedad;

// Implementar método para obtener las propiedades
$propiedades = Propiedad::all();

//Muestra mensaje condicional (alerta)
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $propiedad = Propiedad::find($id);
        
        $propiedad->eliminar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Propiedad Creada Correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Propiedad Actualizada Correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Propiedad Eliminada Correctamente</p>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!--Mostrar los resultados-->
            <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php
incluirTemplate('footer');

//Cerrar la conexión a la BD
mysqli_close($db);
?>