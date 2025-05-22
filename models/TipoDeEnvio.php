<?php 

namespace Model;

class TipoDeEnvio extends ActiveRecord {
    protected static $tabla = 'tipo_de_envio';
    protected static $columnasDB = ['IDenvio', 'tipo_envio', 'costo'];
    protected static $columnaID = 'IDenvio';

    public $IDenvio;
    public $tipo_envio;
    public $costo;

    public function __construct($args = []) {
        $this->IDenvio = $args['IDenvio'] ?? null;
        $this->tipo_envio = $args['tipo_envio'] ?? '';
        $this->costo = $args['costo'] ?? '';
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}
