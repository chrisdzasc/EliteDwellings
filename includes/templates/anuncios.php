<?php

    // Importar la conexion
    $db = conectarDB();

    // Consultar
    $query = "SELECT * FROM propiedades LIMIT $limite "; // La consulta que queremos hacer y la guarda en una variable

    // Obtener los resultados
    $resultado = mysqli_query($db, $query); // Se hace la conexion a la bd y tambien la variable que contiene la consulta

?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <div class="anuncio">
                    <img loading="lazy" src="/bienesraices/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">


                <div class="contenido-anuncio">
                    <h3> <?php echo $propiedad['titulo']; ?> </h3>
                    <p> <?php echo $propiedad['descripcion']; ?> </p>
                    <p class="precio">$<?php echo $propiedad['precio']; ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                            <p> <?php echo $propiedad['wc']; ?> </p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy">
                            <p> <?php echo $propiedad['estacionamiento']; ?> </p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
                            <p> <?php echo $propiedad['habitaciones']; ?> </p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                        Ver propiedad
                    </a>
                </div> <!-- Cierre del .contenido-anuncio-->
            </div> <!-- cierre de .anuncio -->
    <?php endwhile; ?>

</div> <<!-- Cierre de .contenedor-anuncios -->

<?php
    // Cerrar la conexión
    mysqli_close($db);
?>