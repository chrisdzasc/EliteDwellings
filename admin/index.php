<?php

    require '../includes/funciones.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    $auth = estaAutenticado();

    if(!$auth){ // Si no es true
        header('Location: ../index.php'); // Redirecciona a la página de inicio del proyecto
    }

    // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir el query
    $query = "SELECT * FROM propiedades";

    // Consultar la base de dato
    $resultadoConsulta = mysqli_query($db, $query);

    // Muestra mensaje cuando se crea una propiedad nueva
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            // Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']);

            // Elimina la propiedad
            $query = "DELETE FROM propiedades WHERE id = $id";
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /bienesraices/admin/index.php?resultado=3');
            }
        }
    }
    
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        
        <?php if($resultado == 1) :  ?>
            <p class="alerta exito">Propiedad Creada correctamente</p>
        <?php elseif($resultado == 2): ?>
            <p class="alerta actualizado">Propiedad Actualizada correctamente</p>
        <?php elseif($resultado == 3): ?>
            <p class="alerta eliminado">Propiedad Eliminada correctamente</p>
        <?php endif; ?>

        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td> <?php echo $propiedad['id']; ?> </td>
                    <td> <?php echo $propiedad['titulo']; ?> </td>
                    <td> <img src="../imagenes/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla"> </td>
                    <td>$ <?php echo $propiedad['precio']; ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value=" <?php echo $propiedad['id']; ?>"> <!-- No sea visible, pero una vez que le den eliminar se mandan los valores -->

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-azul-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php

    // Cerrar la conexión de la base de datos
    mysqli_close($db);

    incluirTemplate('footer');
?>