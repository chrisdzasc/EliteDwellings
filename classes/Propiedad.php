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
        $this->vendedores_id       = $args['vendedorId'] ?? 1;
    }

    public function guardar(){
        if(isset($this->id)){
            // actualizar
            $this->actualizar();
        }else{
            // Creando un nuevo registro
            $this->crear();
        }
    }

    // Funcion para guardar
    public function crear(){

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

    public function actualizar(){
        // Sanitizar la entrada de los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "$key='$value'";
        }

        $query = "UPDATE propiedades SET "; 
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado){
            // Redireccionar al usuario una vez insertado en la base de datos
            header('Location: /bienesraices/admin/index.php?resultado=2');
        }
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

        // Elimina la imagen previa
        if(isset($this->id)){
            // Comprobar si existe el archivo
            $existeArchivo = file_exists(CARPETAS_IMAGENES . $this->imagen);

            if($existeArchivo){
                unlink(CARPETAS_IMAGENES . $this->imagen);
            }
        }

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

    // Lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = $id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists( $objeto, $key )){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}

?>