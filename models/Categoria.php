<?php 

namespace Model;

class Categoria extends ActiveRecord {

    protected static $tabla = 'categorias';
    protected static $columnasDB = ['IDcategoria', 'nombre', 'descripcion'];
    protected static $columnaID = 'IDcategoria';

    public $IDcategoria;
    public $nombre;
    public $descripcion;

    public function __construct($args = []) {
        $this->IDcategoria = $args['IDcategoria'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre de la categoria es obligatorio';
        }
        if (!$this->descripcion) {
            self::$alertas['error'][] = 'La descripción es obligatoria';
        }
    
        return self::$alertas;
    }
}


?>