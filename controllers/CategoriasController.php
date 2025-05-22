<?php

namespace Controllers;

use Model\Categoria;
use MVC\Router;

class CategoriasController {

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $categoria = new Categoria(); 

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();

            if(empty($alertas)) {
                $resultado = $categoria->guardar();
    
                if($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

        $router->render('admin/categorias/crear', [
            'titulo' => 'Registrar Categoría',
            'alertas' => $alertas,
            'categoria' => $categoria
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
            header('Location: /admin/productos');
        }

        $categoria = Categoria::find($id);

        if(!$categoria) {
            header('Location: /adimn/productos');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            $categoria->sincronizar($_POST);

            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $resultado = $categoria->guardar();
                if ($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }
    
        $router->render('admin/categorias/editar', [
            'titulo' => 'Actualizar Categoria',
            'alertas' => $alertas,
            'categoria' => $categoria
        ]);

    }

    public static function eliminar() {
        if(!is_admin()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $categoria = Categoria::find($id);
            if(!isset($categoria)) {
                header('Location: /admin/productos');
            }
            $resultado = $categoria->eliminar();
            if($resultado) {
                header('Location: /admin/productos');
            }
        }
    }

}


?>