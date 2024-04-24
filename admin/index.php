<?php

    require '../includes/app.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    
    estaAutenticado();

    use App\Propiedad;

    // Importar la conexion
    $db = conectarDB();

    // Implementar un método para obtener todas las propiedades
    $propiedades = Propiedad::all();

    // Muestra mensaje cuando se crea una propiedad nueva
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            
            // Obtener los datos de la propiedad
            $propiedad = Propiedad::find($id);

            $propiedad->eliminar();
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
                <?php foreach( $propiedades as $propiedad ) : ?>
                <tr>
                    <td> <?php echo $propiedad->id; ?> </td>
                    <td> <?php echo $propiedad->titulo; ?> </td>
                    <td> <img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"> </td>
                    <td>$ <?php echo $propiedad->precio; ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value=" <?php echo $propiedad->id; ?>"> <!-- No sea visible, pero una vez que le den eliminar se mandan los valores -->

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-azul-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php

    // Cerrar la conexión de la base de datos
    mysqli_close($db);

    incluirTemplate('footer');
?>