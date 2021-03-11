<?php 

require 'includes/app.php';

incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="destacada 3">
        </picture>

        <h2>Llena el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" placeholder="Nombre">

                <label for="email">E-mail:</label>
                <input type="email" id="email" placeholder="mail@mail.com">

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" placeholder="55-5555-5555">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" placeholder="Mensaje..."></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="opciones">Compra o Venta</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Venta">Venta</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto:</label>
                <input type="number" id="presupuesto" placeholder="$">
            </fieldset>

            <fieldset>
                <legend>Información de Contacto</legend>

                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" id="contactar-telefono" value="telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" id="contactar-email" value="email">
                </div>

                <p>Si eligió teléfono elija fecha y hora</p>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora:</label>
                <input type="time" id="Hora" min="09:00" max="16:00">
            </fieldset>

            <div class="enviar">
                <input type="submit" value="Enviar" class="boton-verde">
            </div>
        </form>
    </main>

<?php incluirTemplate('footer'); ?>