<?php

    // Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /bienesraices/admin/index.php');    
    }

    // Base de Datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = $id"; 
    $resultadoConsulta = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultadoConsulta);

    // Consultar para obtener a los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    $titulo             = $propiedad['titulo'];
    $precio             = $propiedad['precio'];
    $descripcion        = $propiedad['descripcion'] ;
    $habitaciones       = $propiedad['habitaciones'] ;
    $wc                 = $propiedad['wc'];
    $estacionamiento    = $propiedad['estacionamiento'];
    $vendedorId         = $propiedad['vendedores_id'];
    $imagenPropiedad    = $propiedad['imagen'];

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

            $nombreImagen = '';
            
            if($imagen['name']){
                // Eliminar la imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar un nombre unico
                $nombreImagen = md5( uniqid(rand(), true) ) . ".jpeg"; // Va a hashear

                // Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else{
                $nombreImagen = $propiedad['imagen'];
            }

            // Insertar en la Base de Datos
            $query = "UPDATE propiedades SET titulo = '$titulo', precio = '$precio', imagen = '$nombreImagen', descripcion = '$descripcion', 
            habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedorId WHERE id = $id";

            // echo $query; = Para mostrar como quedaria el query y verificar si es correcto

            // Almacenarlo en la base de datos
            $resultado = mysqli_query($db, $query);

            if($resultado){
                // Redireccionar al usuario una vez insertado en la base de datos

                header('Location: /bienesraices/admin/index.php?resultado=2');
            }
        }

    }

    require '../../includes/funciones.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/bienesraices/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

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

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>