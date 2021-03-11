<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título de Propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="0.00" value="<?php echo sanitizar($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">
    <?php if($propiedad->imagen): ?>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen <?php echo $propiedad->id; ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]" placeholder="Descripción de Propiedad..."><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej. 3" value="<?php echo sanitizar($propiedad->habitaciones); ?>" min="1" max="9">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej. 3" value="<?php echo sanitizar($propiedad->wc); ?>" min="1" max="9">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej. 3" value="<?php echo sanitizar($propiedad->estacionamiento); ?>" min="1" max="9">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <!-- <select name="id_vendedor">
        <option <?php echo $id_vendedor === '' ? 'selected disabled' : 'disabled'; ?> value="">-- Seleccione --</option>
        <?php while ($vendedor = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <option <?php echo $id_vendedor === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo sanitizar($propiedad->id_vendedor); ?>"><?php echo sanitizar($vendedor['nombre']) . " " . $vendedor['apellido']; ?></option>
        <?php endwhile; ?>
    </select> -->
</fieldset>