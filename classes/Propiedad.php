<?php

namespace App;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedades';

    // Identifica que forma van a tener los datos
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'id_vendedor'];

    // Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $id_vendedor;

    // Constructor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->id_vendedor = $args['id_vendedor'] ?? '';
    }

    // Validación
    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[0] = "Añade un título a la propiedad";
        }

        if (!$this->precio) {
            self::$errores[] = "Añade un precio a la propiedad";
        }

        if (!$this->imagen) {
            self::$errores[] = 'Añade una imagen de la propiedad';
        }

        if (strlen($this->descripcion) < 30) {
            self::$errores[] = "La descripción debe contener al menos 30 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Añade el número de habitaciones de la propiedad";
        }

        if (!$this->wc) {
            self::$errores[] = "Añade el número de baños de la propiedad";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "Añade el número de lugares de estacionamieto de la propiedad";
        }

        if (!$this->id_vendedor) {
            self::$errores[] = "Elige un vendedor";
        }
        return self::$errores;
    }
}
