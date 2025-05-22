<?php 

namespace Model;

class Pedido extends ActiveRecord {
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['IDpedido', 'producto', 'descripcionPedido', 'cantidad', 'direccion','contacto','FormaPago','fecha','IDenvio','IDcliente','estado'];
    protected static $columnaID = 'IDpedido';

    public $IDpedido;
    public $producto;
    public $descripcionPedido;
    public $cantidad;
    public $direccion;
    public $contacto;
    public $FormaPago;
    public $fecha;
    public $IDenvio;
    public $IDcliente;
    public $estado;

    public function __construct($args = []) {
        $this->IDpedido = $args['IDpedido'] ?? null;
        $this->producto = $args['producto'] ?? '';
        $this->descripcionPedido = $args['descripcionPedido'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->contacto = $args['contacto'] ?? '';
        $this->FormaPago = $args['FormaPago'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->IDenvio = $args['IDenvio'] ?? '';
        $this->IDcliente = $args['IDcliente'] ?? '';
        $this->estado = $args['estado'] ?? 'Pendiente';
    }

    public function validar() {
        if (!$this->producto) {
            self::$alertas['error'][] = 'El nombre del producto es obligatorio';
        }
        if (trim($this->descripcionPedido) === '') {
            self::$alertas['error'][] = 'La descripción del pedido es obligatoria';
        }
        if (!$this->cantidad) {
            self::$alertas['error'][] = 'La cantidad es obligatoria';
        }
        if (!$this->direccion) {
            self::$alertas['error'][] = 'La dirección es obligatoria';
        }
        if (!$this->contacto) {
            self::$alertas['error'][] = 'El contacto es obligatorio';
        }
        if (!$this->FormaPago) {
            self::$alertas['error'][] = 'La forma de pago es obligatoria';
        }
        if (!$this->fecha) {
            self::$alertas['error'][] = 'La fecha de entrega es obligatoria';
        }
        if (!$this->IDenvio) {
            self::$alertas['error'][] = 'La tipo de envio es obligatorio';
        }
        if (!$this->IDcliente) {
            self::$alertas['error'][] = 'El ID del cliente es obligatorio';
        }
        if (!$this->estado) {
            self::$alertas['error'][] = 'El estado del pedido es obligatorio';
        }
    
        return self::$alertas;
    }
}