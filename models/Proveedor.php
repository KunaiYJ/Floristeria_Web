<?php 

namespace Model;

class Proveedor extends ActiveRecord {

    protected static $tabla = 'proveedores';
    protected static $columnasDB = ['IDproveedor', 'nombre', 'telefono', 'direccion', 'ciudad'];
    protected static $columnaID = 'IDproveedor';

    public $IDproveedor;
    public $nombre;
    public $telefono;
    public $direccion;
    public $ciudad;

    public function __construct($args = []) {
        $this->IDproveedor = $args['IDproveedor'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del proveedor es obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El teléfono es obligatorio';
        }
        if (!$this->direccion) {
            self::$alertas['error'][] = 'La dirección es obligatoria';
        }
        if (!$this->ciudad) {
            self::$alertas['error'][] = 'La ciudad es obligatoria';
        }
    
        return self::$alertas;
    }
}


?>