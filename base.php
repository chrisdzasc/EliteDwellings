<?php

    require 'includes/funciones.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    
    incluirTemplate('header', $inicio = true ); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion">
        <h1>Titulo Página</h1>
    </main>

<?php
    incluirTemplate('footer');
?>