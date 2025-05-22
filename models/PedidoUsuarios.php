<?php 

namespace Model;

class PedidoUsuarios extends ActiveRecord {
    protected static $tabla = 'pedidos_usuarios';
    protected static $columnasDB = ['IDpedidoCliente', 'producto', 'descripcion', 'cantidad', 'direccion','contacto','formaPago','fecha','IDenvio','usuarioID','estado'];
    protected static $columnaID = 'IDpedidoCliente';

    public $IDpedidoCliente;
    public $producto;
    public $descripcion;
    public $cantidad;
    public $direccion;
    public $contacto;
    public $formaPago;
    public $fecha;
    public $IDenvio;
    public $usuarioID;
    public $estado;

    public function __construct($args = []) {
        $this->IDpedidoCliente = $args['IDpedidoCliente'] ?? null;
        $this->producto = $args['producto'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->contacto = $args['contacto'] ?? '';
        $this->formaPago = $args['formaPago'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->IDenvio = $args['IDenvio'] ?? '';
        $this->usuarioID = $args['usuarioID'] ?? '';
        $this->estado = $args['estado'] ?? 'Pendiente';
    }

    public function validar() {
        if (!$this->producto) {
            self::$alertas['error'][] = 'El nombre del producto es obligatorio';
        }
        if (trim($this->descripcion) === '') {
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
        if (!$this->formaPago) {
            self::$alertas['error'][] = 'La forma de pago es obligatoria';
        }
        if (!$this->fecha) {
            self::$alertas['error'][] = 'La fecha de entrega es obligatoria';
        }
        if (!$this->IDenvio) {
            self::$alertas['error'][] = 'La tipo de envio es obligatorio';
        }
        if (!$this->usuarioID) {
            self::$alertas['error'][] = 'El ID del cliente es obligatorio';
        }
        if (!$this->estado) {
            self::$alertas['error'][] = 'El estado del pedido es obligatorio';
        }
    
        return self::$alertas;
    }
}