<?php 

require 'includes/funciones.php';

incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la Decoración de tu Hogar</h1>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="destacada 2">
        </picture>
        
        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Quisque varius, metus et imperdiet pharetra, odio felis lobortis sapien, eget pharetra neque dolor ac ante. Nulla tempor arcu volutpat orci lobortis tincidunt. Sed vitae velit sem. Nunc nec convallis quam. Mauris sollicitudin id dui vitae tempus. Fusce sagittis eros ut quam lacinia, at auctor velit porta. Nullam nec ullamcorper felis. Sed fringilla malesuada lobortis. Pellentesque in accumsan odio. Suspendisse lacinia sed enim in luctus. Phasellus feugiat nisi tortor, et mollis orci euismod id. Proin ultricies ultrices aliquet. Nam erat ligula, varius vel dolor sit amet, cursus sagittis augue.
                Suspendisse tellus diam, tincidunt vel massa vel, sollicitudin eleifend urna. Fusce consectetur pellentesque ultricies. Mauris eget elit imperdiet, consequat ante sed, tincidunt turpis.</p>
        </div>
    </main>

<?php incluirTemplate('footer'); ?>