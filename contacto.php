<?php
    include './includes/templates/header.php'; // Incluir o agregar otro archivo
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2>Llene el formulario de Contacto</h2>

        <form class="formulario">
            <fieldset> <!-- Agrupa como en un cuadro -->
                <legend>Información Personal</legend> <!-- Titulo del fieldset -->

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tú Nombre" id="nombre">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tú Email" id="email">

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tú Teléfono" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o Compra:</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Selecciona --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tú Precio o Presupuesto" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>¿Cómo desea ser contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Télefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Sí eligió teléfono, elija la fecha y la hora para ser contactado</p>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion"> <!-- Enlaces -->
                <a href="nosotros.html">Nosotros</a> <!-- Enlace para llevarnos a la página de nostros -->
                <a href="anuncios.html">Anuncios</a> <!-- Enlace para llevarnos a la página de anuncios -->
                <a href="blog.html">Blog</a> <!-- Enlace para llevarnos a la página de blog -->
                <a href="contacto.html">Contacto</a> <!-- Enlace para llevarnos a la página de contacto -->
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados 2024 &copy;</p>
    </footer>
    
    <script src="build/js/bundle.min.js"></script>
</body>
</html>