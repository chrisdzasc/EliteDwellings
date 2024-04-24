<?php

    require '../../includes/app.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    $db = conectarDB(); // Conexion a la base de datos

    // Consultar para obtener a los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    $titulo             = '';
    $precio             = '';
    $descripcion        = '' ;
    $habitaciones       = '' ;
    $wc                 = '';
    $estacionamiento    = '';
    $vendedorId         = '';

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $propiedad = new Propiedad($_POST); // Creando la instancia del nuevo objeto de la propiedad

        // Generar un nombre unico
        $nombreImagen = md5( uniqid(rand(), true) ) . ".jpeg"; // Va a hashear

        // Le vamos a setear la imagen
        // Realiza un resize a la imagen con intervention
        if($_FILES['imagen']['tmp_name']){
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
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

                <select name="vendedorId" >
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