<?php

    // Conexion a la base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    // En caso de que el usuario ingrese información mal, aqui se van a guardar los errores
    $errores = [];

    // Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email      = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)); // Asignamos los valores que obtenemos del metodo POST
        $password   = mysqli_real_escape_string($db, $_POST['password']); // Asignamos los valores que obtenemos del metodo POST

        if(!$email){
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$password){
            $errores[] = "La contraseña es obligatoria";
        }

        if(empty($errores)){

            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'"; // Guarda la sentencia sql en una variable
            $resultado = mysqli_query($db, $query); // Variable en la que se va a guardar los resultados de la consulta

            if($resultado->num_rows){ // En caso de que haya resultados en la consulta sql

                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado); // Guarda en la variable de usuario el arreglo que contiene toda la informacion de ese usuario
                
                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']); // Primer valor es la contraseña que se ingreso y el segundo es la hasheada

                if($auth){ // Si contiene true
                    // El usuario está autenticado
                    session_start(); // Inicia la sesion

                    // Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email']; // Guardamos en el arreglo de usuario el nombre del correo del usuario
                    $_SESSION['login'] = true; // Especificamos que tiene un login

                    header('Location: admin/index.php');

                }else{ // Si contiene false
                    $errores[] = "El Usuario no existe"; // Se agrega un error al arreglo de errores
                }

            }else{ // Si no hay resultados en la consulta
                $errores[] = "El Usuario no existe"; // Se agrega un error al arreglo de errores
            }
            
        }
    }

    // Incluye el Header
    require 'includes/funciones.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset> <!-- Agrupa como en un cuadro -->
                <legend>Email y Password</legend> <!-- Titulo del fieldset -->

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tú Email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tú Password" id="password" required>

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>