<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Usuarios;
use MVC\Router;

class RegistradosController {

    public static function index(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }

        $registros_por_pagina = 5;
        $total = Usuarios::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/registrados?page=1');
        }

        $usuarios = Usuarios::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/registrados/index', [
            'titulo' => 'Registrados Actuales',
            'usuarios' => $usuarios,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        $usuarios = new Usuarios;
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            $usuarios->sincronizar($_POST);
            $alertas = $usuarios->validar();
    
            if (empty($alertas)) {
                if (!empty($_POST['password'])) {
                    $usuarios->hashPassword();
                }
                $resultado = $usuarios->guardar();
    
                if ($resultado) {
                    header('Location: /admin/registrados');
                }
            }
        }
    
        $router->render('admin/registrados/crear', [
            'titulo' => 'Registrar Usuario',
            'alertas' => $alertas,
            'usuarios' => $usuarios,
            'modoEdicion' => false
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        //validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/registrados');
        }

        //Obtener el usuario a editar
        $usuarios = Usuarios::find($id);

        if(!$usuarios) {
            header('Location: /admin/registrados');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            $usuarios->sincronizar($_POST);
            if (!empty($_POST['password'])) {
                $usuarios->hashPassword();
            }
            $alertas = $usuarios->validar();

            if (empty($alertas)) {
                $resultado = $usuarios->guardar();
                if ($resultado) {
                    header('Location: /admin/registrados');
                }
            }
        }

        $router->render('admin/registrados/editar', [
            'titulo' => 'Actualizar Usuario',
            'alertas' => $alertas,
            'usuarios' => $usuarios,
            'modoEdicion' => true
        ]);
    }

    public static function eliminar() {
        if(!is_admin()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $usuarios = Usuarios::find($id);
            if(!isset($usuarios)) {
                header('Location: /admin/registrados');
            }
            $resultado = $usuarios->eliminar();
            if($resultado) {
                header('Location: /admin/registrados');
            }
        }
    }
}


?>