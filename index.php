<?php

    require 'includes/app.php'; // Vamos a tener funciones, clases y bases de datos disponibles
    
    incluirTemplate('header', $inicio = true ); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>seguridad</h3>
                <p>Nuestra prioridad es garantizar la seguridad y tranquilidad de nuestros clientes en cada 
                    paso del proceso de adquisición de su hogar. Trabajamos con los estándares más altos de seguridad y protección 
                    para ofrecerle la tranquilidad que se merece.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Encontrar la propiedad perfecta al precio adecuado es esencial. En nuestra agencia, nos comprometemos a 
                    ofrecerle opciones que se ajusten a su presupuesto y a brindarle transparencia en todas las transacciones 
                    financieras para que pueda tomar decisiones informadas y acertadas.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A tiempo</h3>
                <p>Sabemos que su tiempo es valioso. Nos comprometemos a cumplir con los plazos establecidos y a proporcionarle 
                    un servicio eficiente y oportuno en cada etapa del proceso de compra o venta de su propiedad. 
                    Su satisfacción es nuestra prioridad.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php

            $limite = 3;
            include 'includes/templates/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>

    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>

        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>

        <a href="contacto.php" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog"> <!-- Utilizarlo siempre que se contenga un heading -->
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog"> <!-- Cuando se tenga una entrada de blog -->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>31/03/2024</span> por: <span>Admin</span> </p>

                        <p>
                            Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dineros.
                        </p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog"> <!-- Cuando se tenga una entrada de blog -->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guia para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>31/03/2024</span> por: <span>Admin</span> </p>

                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                        </p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote> <!-- Para hacer una cita -->
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>

                <p>Jose Alejandro Diaz Lopez</p>
            </div>
        </section>
    </div>
<?php
    incluirTemplate('footer');
?>