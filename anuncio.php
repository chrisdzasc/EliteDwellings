<?php
    include './includes/templates/header.php'; // Incluir o agregar otro archivo
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.webp" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000.00</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
                    <p>4</p>
                </li>
            </ul>

            <p>Bienvenido a tu oasis privado frente al bosque. Esta encantadora residencia de estilo contemporáneo ofrece la 
               combinación perfecta de tranquilidad natural y comodidades modernas. Ubicada en una ubicación privilegiada frente 
               al exuberante bosque, esta propiedad es una escapada idílica del bullicio de la ciudad, mientras que aún está 
               convenientemente cerca de todas las comodidades urbanas.</p>
            <p>Al entrar en esta espaciosa casa, serás recibido por una sensación de calidez y luminosidad. El diseño de concepto 
               abierto maximiza la luz natural y proporciona vistas impresionantes del paisaje boscoso que rodea la propiedad. 
               La sala de estar principal es un espacio acogedor ideal para relajarse junto a la chimenea después de un día de 
               exploración al aire libre.</p>
            <p>La cocina gourmet es el sueño de todo chef, equipada con electrodomésticos de alta gama, encimeras de granito y una 
               isla central para mayor funcionalidad. Disfruta de comidas caseras con la familia y amigos en el comedor adyacente, 
               mientras contemplas las vistas serenas del bosque a través de las ventanas panorámicas.</p>
            <p>Esta casa cuenta con cuatro amplias recámaras, cada una diseñada para ofrecer privacidad y confort. La suite principal 
               es un santuario tranquilo con su propio baño completo y un amplio vestidor. Las otras tres recámaras también ofrecen 
               espacio más que suficiente para la familia y los huéspedes, con armarios empotrados y abundante luz natural.</p>
            <p>Disfruta del aire fresco y la serenidad del entorno natural desde el patio trasero, donde encontrarás un amplio espacio 
                para el entretenimiento al aire libre y actividades recreativas. Con tres lugares de estacionamiento disponibles, hay 
                mucho espacio para tus vehículos y equipos de aventura.</p>
            <p>Esta casa en venta frente al bosque es una oportunidad única para disfrutar de la tranquilidad de la naturaleza sin 
               sacrificar la comodidad y el lujo de la vida moderna. ¡Ven y descubre tu nuevo hogar hoy mismo!</p>
        </div>
    </main>

<?php
    include './includes/templates/footer.php'; // Incluir o agregar otro archivo
?>