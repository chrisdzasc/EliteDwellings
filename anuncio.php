<?php

    // Validamos la URL por el ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); // Validamos de que se esté mandando un int 

    if(!$id){
        header('Location: /bienesraices/anuncios.php');
    }

    // Conexión a la base de datos
    require 'includes/config/database.php'; // Recordar que lo está tomando como si fuera desde index.php
    $db = conectarDB();

    // Obtener los datos de la propiedad a mostrar
    $query = "SELECT * FROM propiedades WHERE id = $id";
    $resultadoConsulta = mysqli_query($db, $query);

    if($resultadoConsulta->num_rows === 0){
        header('Location: /bienesraices/anuncios.php');
    }

    $propiedad = mysqli_fetch_assoc($resultadoConsulta);

    require 'includes/funciones.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src="/bienesraices/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">

        <div class="resumen-propiedad">
            <p class="precio">$ <?php echo $propiedad['precio']; ?> </p>

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

            <p> <?php echo $propiedad['descripcion']; ?> </p>
        </div>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');
?>