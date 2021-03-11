<?php

namespace App;

class ActiveRecord
{
    // BD
    protected static $db;

    // Identifica que forma van a tener los datos
    protected static $columnasDB = [];

    // Tabla a la que se hará la consulta
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    // Definir la conexión a la DB
    public static function setDB($database)
    {
        self::$db = $database;
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

        $query = "INSERT INTO " . static::$tabla . " (";
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

        $query = "UPDATE " . static::$tabla . " SET ";
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
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";

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

        foreach (static::$columnasDB as $columna) {
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
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];

        return static::$errores;
    }

    // Lista todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla . ";";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtiene determinado número de registros
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad . ";";
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id};";

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
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    // Convierte un arreglo a objeto
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

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
