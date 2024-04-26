<?php

namespace App;

class ActiveRecord{
    
    // Base de Datos
    protected static $db;
    protected static $columnasDB = []; // Todas las columnas que tenemos en la BD
    protected static $tabla = '';

    // Visibilidad de los atributos
    public $id;
    public $imagen;
    public $titulo;
    public $precio;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    // Errores o Validación
    protected static $errores = [];

    // Definir la conexion a la Bd
    public static function setDB($database){
        self::$db = $database;
    }    

    public function guardar(){
        if(!is_null($this->id)){
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
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query); // Insertando en la base de datos

        if($resultado){
            // Redireccionar al usuario una vez insertado en la base de datos
            header('Location: /bienesraices/admin/index.php?resultado=1');
        }
    }

    public function actualizar(){
        // Sanitizar la entrada de los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "$key='$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET "; 
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado){
            // Redireccionar al usuario una vez insertado en la base de datos
            header('Location: /bienesraices/admin/index.php?resultado=2');
        }
    }

    public function eliminar(){
        // Elimina la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('Location: /bienesraices/admin/index.php?resultado=3');
        }
    }

    // Se va a encargar de iterar sobre $columnasDB. identificar y unir losa atributos de la BD.
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
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
        if(!is_null($this->id)){
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Eliminar archivo de imagen
    public function borrarImagen(){
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETAS_IMAGENES . $this->imagen);

        if($existeArchivo){
            unlink(CARPETAS_IMAGENES . $this->imagen);
        }
    }

    // Validacion
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    // Lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

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