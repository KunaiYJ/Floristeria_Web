<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Cliente;
use MVC\Router;

class ClientesController {

    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/clientes?page=1');
        }

        $por_pagina = 5;
        $total = Cliente::total();
        $paginacion =  new Paginacion($pagina_actual, $por_pagina, $total);

        $clientes = Cliente::paginar($por_pagina, $paginacion->offset());

        $router->render('admin/clientes/index', [
            'titulo' => 'Clientes Actuales',
            'clientes' => $clientes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $cliente = new Cliente; 

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();

            if(empty($alertas)) {
                $resultado = $cliente->guardar();
    
                if($resultado) {
                    header('Location: /admin/clientes');
                }
            }
        }

        $router->render('admin/clientes/crear', [
            'titulo' => 'Registrar Clientes',
            'alertas' => $alertas,
            'cliente' => $cliente
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/clientes');
        }

        $cliente = Cliente::find($id);

        if(!$cliente) {
            header('Location: /adimn/clientes');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            $cliente->sincronizar($_POST);

            $alertas = $cliente->validar();

            if (empty($alertas)) {
                $resultado = $cliente->guardar();
                if ($resultado) {
                    header('Location: /admin/clientes');
                }
            }
        }
    
        $router->render('admin/clientes/editar', [
            'titulo' => 'Actualizar Cliente',
            'alertas' => $alertas,
            'cliente' => $cliente
        ]);

    }

    public static function eliminar() {
        if(!is_admin()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cliente = Cliente::find($id);
            if(!isset($cliente)) {
                header('Location: /admin/clientes');
            }
            $resultado = $cliente->eliminar();
            if($resultado) {
                header('Location: /admin/clientes');
            }
        }
    }

}




?>