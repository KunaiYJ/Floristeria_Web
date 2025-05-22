<?php

namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $columnasDB = ['IDproducto', 'nombreProducto', 'descripcion', 'imagen', 'tags', 'cantidad_flores', 'precio', 'stock', 'IDproveedor', 'IDcategoria'];
    protected static $columnaID = 'IDproducto';

    public $IDproducto;
    public $nombreProducto;
    public $descripcion;
    public $imagen;
    public $tags;
    public $cantidad_flores;
    public $precio;
    public $stock;
    public $IDproveedor;
    public $IDcategoria;

    public ?string $imagen_actual = null;
    
    public function __construct($args = [])
    {
        $this->IDproducto = $args['IDproducto'] ?? null;
        $this->nombreProducto = $args['nombreProducto'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->cantidad_flores = $args['cantidad_flores'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->stock = $args['stock'] ?? '';
        $this->IDproveedor = $args['IDproveedor'] ?? null;
        $this->IDcategoria = $args['IDcategoria'] ?? null;
    }

    public function reducirStock($cantidad) {
        $this->stock -= $cantidad;
        if ($this->stock < 0) {
            $this->stock = 0; // Evitar valores negativos en el stock
        }
        $this->guardar(); // Guardar el nuevo stock en la base de datos
    }

    public function validar() {
        if (!$this->nombreProducto) {
            self::$alertas['error'][] = 'El nombre del producto es obligatorio';
        }
        if (!$this->descripcion) {
            self::$alertas['error'][] = 'El campo descripción del producto es obligatoria';
        }
        if (!$this->imagen) {
            self::$alertas['error'][] = 'El campo imagen es obligatorio';
        }
        if (!$this->tags) {
            self::$alertas['error'][] = 'El campo de flores es obligatorio';
        }
        if (!$this->cantidad_flores) {
            self::$alertas['error'][] = 'El campo de cantidad de flores es obligatorio';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'El campo precio es obligatorio';
        }
        if (!$this->stock) {
            self::$alertas['error'][] = 'El campo stock es obligatorio';
        }
        if (!$this->IDproveedor) {
            self::$alertas['error'][] = 'Seleccione un Proveedor';
        }
        if (!$this->IDcategoria) {
            self::$alertas['error'][] = 'Seleccione una Categoria';
        }
    
        return self::$alertas;
    }
}

class Proveedor extends ActiveRecord {
    protected static $tabla = 'proveedores';
    protected static $columnasDB = ['IDproveedor', 'nombre'];
    protected static $columnaID = 'IDproveedor';

    public $IDproveedor;
    public $nombre;

    public function __construct($args = [])
    {
        $this->IDproveedor = $args['IDproveedor'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}

?>