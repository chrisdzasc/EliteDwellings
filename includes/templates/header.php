<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Dwellings</title>
    <link rel="icon" href="build/img/eliteDwellings.webp">
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; // Si la variable de $inicio es true, entonces agrega la clase 'inicio' sino no le agregues nada  ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php"> <!-- Link para regresarnos a la pagina principal clickeando el logo de la página -->
                    <img class="logo" src="build/img/logo.svg" alt="Logotipo de Elite Dwellings"> <!-- Logo de la página -->
                </a>

                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="Menú Responsive">
                </div>

                <div class="derecha">

                    <img class="dark-mode-boton" src="build/img/dark-mode.svg" alt="Botón para Dark Mode">

                    <nav class="navegacion"> <!-- Enlaces -->
                        <a href="nosotros.php">Nosotros</a> <!-- Enlace para llevarnos a la página de nostros -->
                        <a href="anuncios.php">Anuncios</a> <!-- Enlace para llevarnos a la página de anuncios -->
                        <a href="blog.php">Blog</a> <!-- Enlace para llevarnos a la página de blog -->
                        <a href="contacto.php">Contacto</a> <!-- Enlace para llevarnos a la página de contacto -->
                    </nav>
                </div>

            </div> <!-- Cierre de la barra de navegación -->
            <?php
            if($inicio){ ?>
               <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>"
            <?php } ?>
        </div>

    </header>