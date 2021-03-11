<?php

namespace App;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';

    // Identifica que forma van a tener los datos
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    // Atributos
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    // Constructor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    // Validación
    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[0] = "Añade el nombre del vendedor";
        }

        if (!$this->apellido) {
            self::$errores[] = "Añade el apellido del vendedor";
        }

        if (!$this->telefono) {
            self::$errores[] = 'Añade el teléfono del vendedor';
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = 'Formato de teléfono no válido';
        }

        return self::$errores;
    }
}
