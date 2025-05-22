<?php

namespace Model;

class Venta extends ActiveRecord {
    protected static $tabla = 'ventas';
    protected static $columnasDB = ['IDventa', 'ProductoID', 'ClienteID', 'cantidad', 'total', 'fecha'];
    protected static $columnaID = 'IDventa';

    public $IDventa;
    public $ProductoID;
    public $ClienteID;
    public $cantidad;
    public $total;
    public $fecha;

    public function __construct($args = []) {
        $this->IDventa = $args['IDventa'] ?? null;
        $this->ProductoID = $args['ProductoID'] ?? '';
        $this->ClienteID = $args['ClienteID'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->fecha = date('Y-m-d');
    }

    public function validar() {
        if (!$this->ProductoID) {
            self::$alertas['error'][] = 'Seleccione un producto a vender';
        }
        if (!$this->ClienteID) {
            self::$alertas['error'][] = 'Seleccione un cliente';
        }
        if (!$this->cantidad) {
            self::$alertas['error'][] = 'La cantidad de producto es obligatoria';
        }
    
        return self::$alertas;
    }
}


?>