<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="destacada 1">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000.00</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li> 
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>

            <p>Quisque varius, metus et imperdiet pharetra, odio felis lobortis sapien, eget pharetra neque dolor ac ante. Nulla tempor arcu volutpat orci lobortis tincidunt. Sed vitae velit sem. Nunc nec convallis quam. Mauris sollicitudin id dui vitae tempus. Fusce sagittis eros ut quam lacinia, at auctor velit porta. Nullam nec ullamcorper felis. Sed fringilla malesuada lobortis. Pellentesque in accumsan odio. Suspendisse lacinia sed enim in luctus. Phasellus feugiat nisi tortor, et mollis orci euismod id. Proin ultricies ultrices aliquet. Nam erat ligula, varius vel dolor sit amet, cursus sagittis augue.
                Suspendisse tellus diam, tincidunt vel massa vel, sollicitudin eleifend urna. Fusce consectetur pellentesque ultricies. Mauris eget elit imperdiet, consequat ante sed, tincidunt turpis.</p>
        </div>
    </main>

<?php include 'includes/templates/footer.php'; ?>