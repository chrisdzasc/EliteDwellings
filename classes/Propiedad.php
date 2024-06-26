<?php

namespace App;

class Propiedad extends ActiveRecord{

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 
                                    'vendedores_id']; // Todas las columnas que tenemos en la BD

    protected static $tabla = 'propiedades';

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

        // Constructor
        public function __construct($args = [])
        {
            $this->id               = $args['id'] ?? null ;
            $this->titulo           = $args['titulo'] ?? '';
            $this->precio           = $args['precio'] ?? '';
            $this->imagen           = $args['imagen'] ?? '';
            $this->descripcion      = $args['descripcion'] ?? '';
            $this->habitaciones     = $args['habitaciones'] ?? '';
            $this->wc               = $args['wc'] ?? '';
            $this->estacionamiento  = $args['estacionamiento'] ?? '';
            $this->creado           = date('Y/m/d');
            $this->vendedores_id    = $args['vendedorId'] ?? '';
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