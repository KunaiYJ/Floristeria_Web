<?php

namespace Model;

class Usuarios extends ActiveRecord {

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['IDusuario', 'nombre', 'apellido', 'email', 'password', 'confirmado', 'token', 'estatus', 'IDrol'];
    protected static $columnaID = 'IDusuario';

    public $IDusuario;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $confirmado;
    public $token;
    public $estatus;
    public $IDrol;

    public function __construct($args = [])
    {
        $this->IDusuario = $args['IDusuario'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->estatus = $args['estatus'] ?? '';
        $this->IDrol = $args['IDrol'] ?? null;
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Correo es Obligatorio';
        }
        if(!$this->password && $this->IDusuario === null) {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }
        if(!$this->estatus === '') {
            self::$alertas['error'][] = 'El Estatus es obligatorio';
        }
        if(!$this->IDrol) {
            self::$alertas['error'][] = 'El Tipo de Usuario es obligatorio';
        }
    
        return self::$alertas;
    }

    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function getEstatusText() {
        $estatus = [
            0 => 'Inactivo',
            1 => 'Activo'
        ];
        return $estatus[$this->estatus] ?? 'Desconocido';
    }

    public function getEstatusClass() {
        $estatusClasses = [
            0 => 'estatus-inactivo',
            1 => 'estatus-activo'
        ];
        return $estatusClasses[$this->estatus] ?? 'estatus-desconocido';
    }

    public function getRolText() {
        $roles = [
            1 => 'Administrador',
            2 => 'Empleado',
            3 => 'Cliente'
        ];
        return $roles[$this->IDrol] ?? 'Desconocido';
    }
}

?>