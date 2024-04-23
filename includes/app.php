<?php // Archivo que va a mandar llamar funciones, bases de datos y clases.

require 'funciones.php'; // Archivo que va a mandar llamar funciones y clases

require 'config/database.php'; // Para obtener la conexión a la base de datos

require __DIR__ . '/../vendor/autoload.php'; // Para incluir el autoload

use App\Propiedad;

?>