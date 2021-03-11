<fieldset>
    <legend>Información Personal</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del Vendedor" value="<?php echo sanitizar($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="precio" name="vendedor[apellido]" placeholder="Apellido del Vendedor" value="<?php echo sanitizar($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Contacto</legend>

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="55-555-555-55" value="<?php echo sanitizar($vendedor->telefono); ?>">
</fieldset>