<?php

require 'app.php'; // Incluye el archivo 'app.php', que contiene las constantes

function incluirTemplate( string $nombre, bool $inicio = false ){
    include TEMPLATES_URL . "/$nombre.php"; // Incluye un archivo de plantilla según el nombre proporcionado.
    // TEMPLATES_URL es una constante definida en el 'app.php' que contiene la ruta al directorio de plantillas.
    // $nombre es el nombre del archivo de plantilla a incluir, y se espera que exista en el directorio de plantillas.
}