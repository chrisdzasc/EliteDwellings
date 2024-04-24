<?php

    require '../../includes/app.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    $db = conectarDB(); // Conexion a la base de datos

    $propiedad = new Propiedad;

    // Consultar para obtener a los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $propiedad = new Propiedad($_POST['propiedad']); // Creando la instancia del nuevo objeto de la propiedad

        // Generar un nombre unico
        $nombreImagen = md5( uniqid(rand(), true) ) . ".jpeg"; // Va a hashear

        // Le vamos a setear la imagen
        // Realiza un resize a la imagen con intervention
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        // Validar
        $errores = $propiedad->validar(); 

        // Revisar que el arreglo de errores esté vacio
        if(empty($errores)){

            // Crear la carpeta para subir imagenes
            if(!is_dir(CARPETAS_IMAGENES)){
                mkdir(CARPETAS_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $image->save(CARPETAS_IMAGENES . $nombreImagen);

            // guarda en la base de datos
            $resultado = $propiedad->guardar();

            if($resultado){
                // Redireccionar al usuario una vez insertado en la base de datos
                header('Location: /bienesraices/admin/index.php?resultado=1');
            }
        }

    }
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

        <form class="formulario" method="POST" action="/bienesraices/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>