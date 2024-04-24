<?php

namespace App;

class Propiedad{

    // Base de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 
                                    'vendedores_id']; // Todas las columnas que tenemos en la BD

    // Errores o Validación
    protected static $errores = [];

    //Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    // Definir la conexion a la Bd
    public static function setDB($database){
        self::$db = $database;
    }    

    // Constructor
    public function __construct($args = [])
    {
        $this->id               = $args['id'] ?? '';
        $this->titulo           = $args['titulo'] ?? '';
        $this->precio           = $args['precio'] ?? '';
        $this->imagen           = $args['imagen'] ?? '';
        $this->descripcion      = $args['descripcion'] ?? '';
        $this->habitaciones     = $args['habitaciones'] ?? '';
        $this->wc               = $args['wc'] ?? '';
        $this->estacionamiento  = $args['estacionamiento'] ?? '';
        $this->creado           = date('Y/m/d');
        $this->vendedores_id       = $args['vendedorId'] ?? '';
    }

    // Funcion para guardar
    public function guardar(){

        // Sanitizar la entrada de los datos
        $atributos = $this->sanitizarDatos();
        
        // Insertar en la Base de Datos
        $query = " INSERT INTO propiedades( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query); // Insertando en la base de datos

        return $resultado;
    }

    // Se va a encargar de iterar sobre $columnasDB. identificar y unir losa atributos de la BD.
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue; // Cuando se cumpla la condición, deja de ejecutar el if, es como si lo ignorara.
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Se va a encargar de sanitizar cada uno de ellos. 
    public function sanitizarDatos(){
        $atributos = $this->atributos(); // Obtenemos los atributos.
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value); // Lo sanitizamos a cada uno de ellos
        }

        return $sanitizado; // Lo retornamos
    }

    // Subida de archivos
    public function setImagen($imagen){
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo a la propiedad";
        }

        if(!$this->precio){
            self::$errores[] = "El precio de la propiedad es obligatorio";
        }

        if( strlen( $this->descripcion ) < 50){
            self::$errores[] = "Debes añadir una descripción de al menos 50 carácteres a la propiedad";
        }

        if(!$this->habitaciones){
            self::$errores[] = "Debes indicar cuántas habitaciones tiene la propiedad";
        }

        if(!$this->wc){
            self::$errores[] = "Debes indicar cuántos baños tiene la propiedad";
        }

        if(!$this->estacionamiento){
            self::$errores[] = "Debes indicar cuántos lugares de estacionamiento tiene la propiedad";
        }

        if(!$this->vendedores_id){
            self::$errores[] = "Tienes que elegir un vendedor para la propiedad";
        }

        if(!$this->imagen){
            self::$errores[] = "La propiedad debe de tener una imagen";
        }

        return self::$errores;
    }
}

?>