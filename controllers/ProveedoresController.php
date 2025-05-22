<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Proveedor;
use MVC\Router;

class ProveedoresController {

    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/proveedores?page=1');
        }

        $por_pagina = 5;
        $total = Proveedor::total();
        $paginacion =  new Paginacion($pagina_actual, $por_pagina, $total);

        $proveedores = Proveedor::paginar($por_pagina, $paginacion->offset());

        $router->render('admin/proveedores/index', [
            'titulo' => 'Proveedores Actuales',
            'proveedores' => $proveedores,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $proveedor = new Proveedor(); 

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

            $proveedor->sincronizar($_POST);
            $alertas = $proveedor->validar();

            if(empty($alertas)) {
                $resultado = $proveedor->guardar();
    
                if($resultado) {
                    header('Location: /admin/proveedores');
                }
            }
        }

        $router->render('admin/proveedores/crear', [
            'titulo' => 'Registrar Proveedores',
            'alertas' => $alertas,
            'proveedor' => $proveedor
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
            header('Location: /admin/proveedores');
        }

        $proveedor = Proveedor::find($id);

        if(!$proveedor) {
            header('Location: /adimn/proveedores');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            $proveedor->sincronizar($_POST);

            $alertas = $proveedor->validar();

            if (empty($alertas)) {
                $resultado = $proveedor->guardar();
                if ($resultado) {
                    header('Location: /admin/proveedores');
                }
            }
        }
    
        $router->render('admin/proveedores/editar', [
            'titulo' => 'Actualizar Proveedor',
            'alertas' => $alertas,
            'proveedor' => $proveedor
        ]);

    }

    public static function eliminar() {
        if(!is_admin()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $proveedor = Proveedor::find($id);
            if(!isset($proveedor)) {
                header('Location: /admin/proveedores');
            }
            $resultado = $proveedor->eliminar();
            if($resultado) {
                header('Location: /admin/proveedores');
            }
        }
    }

}


?>