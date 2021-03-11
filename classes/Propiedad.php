<?php

namespace App;

class Propiedad
{
    // BD
    protected static $db;

    // Identifica que forma van a tener los datos
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'id_vendedor'];

    // Errores
    protected static $errores = [];

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

    // Definir la conexión a la DB
    public static function setDB($database)
    {
        self::$db = $database;
    }

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
        $this->id_vendedor = $args['id_vendedor'] ?? 1;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    // Crear un nuevo registro
    public function crear()
    {
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO propiedades (";
        $query .=  join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join('\', \'', array_values($atributos));
        $query .= "');";

        $resultado = self::$db->query($query);

        // Mensaje de éxito o error
        if ($resultado) {
            //Redireccionar al usuario
            //Funciona solo si esta antes del HTML
            header('Location: /admin?resultado=1');
        }
    }

    // Actualizar un registro
    public function actualizar()
    {
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = " . self::$db->escape_string($this->id);
        $query .= " LIMIT 1;";

        $resultado = self::$db->query($query);

        // Mensaje de éxito o error
        if ($resultado) {
            //Redireccionar al usuario
            //Funciona solo si esta antes del HTML
            header('Location: /admin?resultado=2');
        }
    }

    // Eliminar un registro
    public function eliminar()
    {
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";

        $resultado = self::$db->query($query);

        // Mensaje de éxito o error
        if ($resultado) {
            // Borrar imagen
            $this->borrarImagen();

            //Redireccionar al usuario
            //Funciona solo si esta antes del HTML
            header('Location: /admin?resultado=3');
        }
    }

    // Identifica y une los atributos de la DB
    public function atributos()
    {
        $atributos = [];

        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;

            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Subida de archivos
    public function setImagen($imagen)
    {
        // Elimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Borrar archivos
    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Validación
    public static function getErrores()
    {
        return self::$errores;
    }

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

    // Lista todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM propiedades;";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id)
    {
        $query = "SELECT * FROM propiedades WHERE id = ${id};";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        // Consultar la DB
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    // Convierte un arreglo a objeto
    protected static function crearObjeto($registro)
    {
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
