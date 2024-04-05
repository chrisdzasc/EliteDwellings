<?php

    $resultado = $_GET['resultado'] ?? null;
    require '../includes/funciones.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        
        <?php if($resultado == 1) :  ?>
            <p class="alerta exito">Propiedad creada correctamente</p>
        <?php endif; ?>

        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>

<?php
    incluirTemplate('footer');
?>