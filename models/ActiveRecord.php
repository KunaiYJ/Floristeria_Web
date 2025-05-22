<?php

namespace Model;

class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $columnaID = 'ID'; // Nueva propiedad para la columna ID

    // Alertas y Mensajes
    protected static $alertas = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    // Setear un tipo de Alerta
    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Obtener las alertas
    public static function getAlertas() {
        return static::$alertas;
    }

    // Validación que se hereda en modelos
    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria (Active Record)
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === static::$columnaID) continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if (!is_null($this->{static::$columnaID})) {
            // Actualizar
            $resultado = $this->actualizar();
        } else {
            // Crear
            $resultado = $this->crear();
        }
        
        // Depurar el resultado
        if (is_array($resultado) && !$resultado['resultado']) {
            echo 'Error al guardar: ' . self::$db->error;
        }
        
        return $resultado;
    }

    // Obtener todos los Registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY " . static::$columnaID . " DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE " . static::$columnaID . " = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite} ORDER BY " . static::$columnaID . " DESC";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    //Paginar los registros
    public static function paginar($por_pagina, $offset) {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY " . static::$columnaID . " DESC LIMIT {$por_pagina} OFFSET {$offset}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busqueda Where con Columna 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Traer total de registros
    public static function total() {
        $query = "SELECT COUNT(*) FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();

        return array_shift($total);
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Crear la consulta
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ("; 
        $query .= join(', ', array_map(function($valor) {
            return is_null($valor) ? 'NULL' : "'{$valor}'";
        }, array_values($atributos)));
        $query .= ")";
        
        // Ejecutar la consulta
        $resultado = self::$db->query($query);
        
        // Verificar si hay un error en la consulta
        if (!$resultado) {
            die('Error en la consulta SQL: ' . self::$db->error);
        }
        
        return [
            'resultado' => $resultado,
            static::$columnaID => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        
        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE " . static::$columnaID . " = '" . self::$db->escape_string($this->{static::$columnaID}) . "' ";
        $query .= " LIMIT 1 "; 
        
        // Actualizar BD
        $resultado = self::$db->query($query);
        
        // Verificar si hay un error en la consulta
        if (!$resultado) {
            die('Error en la consulta SQL: ' . self::$db->error);
        }
        
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE " . static::$columnaID . " = " . self::$db->escape_string($this->{static::$columnaID}) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
}


?>