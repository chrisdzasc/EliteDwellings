<?php

// Define la constante para la ruta al directorio de plantillas
define('TEMPLATES_URL', __DIR__ . '/templates');

// Defina la constante para la ruta al archivo de funciones
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

define('CARPETAS_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false ){
    include TEMPLATES_URL . "/$nombre.php"; // Incluye un archivo de plantilla según el nombre proporcionado.
    // TEMPLATES_URL es una constante definida en el 'app.php' que contiene la ruta al directorio de plantillas.
    // $nombre es el nombre del archivo de plantilla a incluir, y se espera que exista en el directorio de plantillas.
}

function estaAutenticado(){ // estaAutenticado() va a regresar un booleano
    session_start(); // Inicia la session

    if(!$_SESSION['login'] ){ // Si es true
        header('Location: /');
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapar / sanitizar el HTML
function s($html): string{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de Contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}