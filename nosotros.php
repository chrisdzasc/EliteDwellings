<?php
    include './includes/templates/header.php'; // Incluir o agregar otro archivo
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>

                <p>Con 25 años de experiencia en el mercado inmobiliario, nuestra empresa se enorgullece de haber sido parte 
                   de innumerables historias de éxito en la compra, venta y alquiler de propiedades. Durante este tiempo, hemos 
                   acumulado un profundo conocimiento del mercado y hemos establecido relaciones sólidas con clientes, agentes 
                   y asociados. Nuestro compromiso con la excelencia y la satisfacción del cliente ha sido el pilar de nuestro 
                   éxito, y nos esforzamos cada día por mantener los más altos estándares de servicio y profesionalismo.</p>
                
                <p>Con un legado de 25 años en el mercado inmobiliario, nuestra empresa ha evolucionado constantemente para satisfacer 
                   las cambiantes necesidades de nuestros clientes. Desde nuestros inicios, hemos mantenido un enfoque centrado en el 
                   cliente, ofreciendo un servicio personalizado y soluciones innovadoras que se adaptan a cada situación única. 
                   Nuestra larga trayectoria de éxito se basa en valores fundamentales de integridad, confianza y dedicación, 
                   convirtiéndonos en el socio de confianza para aquellos que buscan una experiencia inmobiliaria excepcional.</p>

            </div>
        </div>
    </main>

    <section class="contenedor seccion">
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
    </section>

<?php
    include './includes/templates/footer.php'; // Incluir o agregar otro archivo
?>