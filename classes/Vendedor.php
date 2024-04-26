<?php

namespace App;

class Vendedor extends ActiveRecord{

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono']; // Todas las columnas que tenemos en la BD

    protected static $tabla = 'vendedores';

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    // Constructor
    public function __construct($args = [])
    {
        $this->id               = $args['id'] ?? null ;
        $this->nombre            = $args['nombre'] ?? '';
        $this->apellido          = $args['apellido'] ?? '';
        $this->telefono          = $args['telefono'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "Debes añadir un nombre al vendedor";
        }

        if(!$this->apellido){
            self::$errores[] = "Debes añadir un apellido al vendedor";
        }

        if(!$this->telefono){
            self::$errores[] = "Debes añadir un teléfono al vendedor";
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato no válido en el télefono";
        }

        return self::$errores;
    }
}