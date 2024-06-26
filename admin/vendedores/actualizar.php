<?php

require '../../includes/app.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
use App\Vendedor;
estaAutenticado();

// Valida que sea un ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /bienesraices/admin/index.php');    
}

// Obtener el arreglo del vendedor
$vendedor = Vendedor::find($id);

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

// Ejecutar el código después de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Asignar los valores
    $args = $_POST['vendedor'];

    // Sincronizar objeto en memoria con lo que el usuario escribió
    $vendedor->sincronizar($args);

    // Validacion
    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }
}


incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.

?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            
            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>