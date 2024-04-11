<?php

    require '../../includes/funciones.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    $auth = estaAutenticado();

    if(!$auth){ // Si no es true
        header('Location: ../../index.php'); // Redirecciona a la página de inicio del proyecto
    }

    // Base de Datos
    require '../../includes/config/database.php';

    $db = conectarDB();

    // Consultar para obtener a los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    $titulo             = '';
    $precio             = '';
    $descripcion        = '' ;
    $habitaciones       = '' ;
    $wc                 = '';
    $estacionamiento    = '';
    $vendedorId         = '';

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //echo "<pre>";
        //var_dump($_POST);
        //echo "</pre>";

        //echo "<pre>";
        //var_dump($_FILES);
        //echo "</pre>";

        // Guardando los valores del formulario en cada varible
        $titulo             = mysqli_real_escape_string($db, $_POST['titulo'] );
        $precio             = mysqli_real_escape_string($db, $_POST['precio'] );
        $descripcion        = mysqli_real_escape_string($db, $_POST['descripcion'] );
        $habitaciones       = mysqli_real_escape_string($db, $_POST['habitaciones'] );
        $wc                 = mysqli_real_escape_string($db, $_POST['wc'] );
        $estacionamiento    = mysqli_real_escape_string($db, $_POST['estacionamiento'] );
        $vendedorId         = mysqli_real_escape_string($db, $_POST['vendedor'] );
        $creado             = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = "Debes añadir un titulo a la propiedad";
        }

        if(!$precio){
            $errores[] = "El precio de la propiedad es obligatorio";
        }

        if( strlen( $descripcion ) < 50){
            $errores[] = "Debes añadir una descripción de al menos 50 carácteres a la propiedad";
        }

        if(!$habitaciones){
            $errores[] = "Debes indicar cuántas habitaciones tiene la propiedad";
        }

        if(!$wc){
            $errores[] = "Debes indicar cuántos baños tiene la propiedad";
        }

        if(!$estacionamiento){
            $errores[] = "Debes indicar cuántos lugares de estacionamiento tiene la propiedad";
        }

        if(!$vendedorId){
            $errores[] = "Tienes que elegir un vendedor para la propiedad";
        }

        if(!$imagen['name'] || $imagen['error']){
            $errores[] = "La propiedad debe de tener una imagen";
        }

        // Validar por tamaño de la imagen (100 kb máximo)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){
            $errores[] = "La imagen es muy pesada. Intenta con una más ligera";
        }

        // Revisar que el arreglo de errores esté vacio
        if(empty($errores)){

            // Subida de archivos
            $carpetaImagenes = '../../imagenes/'; // Crear carpeta

            if(!is_dir($carpetaImagenes)){ // Verificar si la carpeta 'imagenes' existe
                mkdir($carpetaImagenes); // Si no existe, la va a crear
            }

            // Generar un nombre unico
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpeg"; // Va a hashear

            // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            // Insertar en la Base de Datos
            $query = "INSERT INTO propiedades(titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
            VALUES ( '$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId' );";

            // echo $query; = Para mostrar como quedaria el query y verificar si es correcto

            // Almacenarlo en la base de datos
            $resultado = mysqli_query($db, $query);

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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción de la propiedad:</label>
                <textarea id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">¿Cuántas habitaciones tiene la propiedad?</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $habitaciones; ?>"
                >

                <label for="wc">¿Cuántos baños tiene la propiedad?</label>
                <input 
                    type="number" 
                    id="wc" 
                    name="wc" 
                    placeholder="Ej: 4" 
                    min="1" 
                    max="9" 
                    value="<?php echo $wc; ?>"
                >

                <label for="estacionamiento">¿Cuántas lugares de estacionamiento tiene la propiedad?</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="estacionamiento" 
                    placeholder="Ej: 2" 
                    min="1" 
                    max="5" 
                    value="<?php echo $estacionamiento; ?>"
                >

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor" >
                    <option value="">-- Seleccione --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?>  value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . " " . $row['apellido']; ?></option>
                    <?php endwhile ?>
                </select>

            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>