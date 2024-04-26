<?php

require '../../includes/app.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

// Ejecutar el código después de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Crear una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);

    // Validar que no exista campos vacios
    $errores = $vendedor->validar();

    // No hay errores
    if(empty($errores)){
        $vendedor->guardar();
    }
}


incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.

?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

        <form class="formulario" method="POST" action="/bienesraices/admin/vendedores/crear.php">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            
            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>