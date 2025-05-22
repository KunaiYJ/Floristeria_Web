<?php 

namespace Model;

class Cliente extends ActiveRecord {

    protected static $tabla = 'clientes';
    protected static $columnasDB = ['IDcliente', 'nombre', 'telefono', 'direccion'];
    protected static $columnaID = 'IDcliente';

    public $IDcliente;
    public $nombre;
    public $telefono;
    public $direccion;

    public function __construct($args = []) {
        $this->IDcliente = $args['IDcliente'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del cliente es obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El teléfono es obligatorio';
        }
        if (!$this->direccion) {
            self::$alertas['error'][] = 'La dirección es obligatoria';
        }
    
        return self::$alertas;
    }
}


?>