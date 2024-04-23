<?php

    require 'includes/app.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion">
        <h2>Casas y Depas en Venta</h2>
    
        <?php

            $limite = 10;
            include 'includes/templates/anuncios.php';
        ?>
    </main>

<?php
    incluirTemplate('footer');
?>