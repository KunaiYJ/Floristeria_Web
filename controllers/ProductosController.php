<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\Categoria;
use Model\Proveedor;
use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;

class ProductosController {

    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/productos?page=1');
        }

        $por_pagina = 8;
        $total = Producto::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        $productos = Producto::paginar($por_pagina, $paginacion->offset());
        $categorias = Categoria::all();

        $router->render('admin/productos/index', [
            'titulo' => 'Productos - Categorias',
            'productos' => $productos,
            'categorias' => $categorias,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $producto = new Producto;
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/products';

                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_jpg = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600)->encode('jpg', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600)->encode('webp', 80);
                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            }

            $producto->sincronizar($_POST);
            $alertas = $producto->validar();

            if(empty($alertas)) {
                $imagen_jpg->save($carpeta_imagenes . '/' . $nombre_imagen . ".jpg");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                $resultado = $producto->guardar();
                if($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

        $router->render('admin/productos/crear', [
            'titulo' => 'Registrar Producto',
            'alertas' => $alertas,
            'producto' => $producto,
            'proveedores' => $proveedores,
            'categorias' => $categorias
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

        $producto = Producto::find($id);
        if(!$producto) {
            header('Location: /admin/productos');
        }

        $proveedores = Proveedor::all();
        $categorias = Categoria::all();
        $producto->imagen_actual = $producto->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/products';

                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_jpg = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600)->encode('jpg', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600)->encode('webp', 80);
                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $producto->imagen_actual;
            }

            $producto->sincronizar($_POST);
            $alertas = $producto->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_jpg->save($carpeta_imagenes . '/' . $nombre_imagen . ".jpg");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }

                $resultado = $producto->guardar();
                if($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

        $router->render('admin/productos/editar', [
            'titulo' => 'Actualizar Producto',
            'alertas' => $alertas,
            'producto' => $producto,
            'proveedores' => $proveedores ?? '',
            'categorias' => $categorias ?? ''
        ]);
    }

    public static function eliminar() {
        if(!is_admin()) {
            header('Location: /login');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
                exit;
            }

            $id = $_POST['id'];

            if(isset($_POST['eliminar_producto'])) {
                $producto = Producto::find($id);

                if(!$producto) {
                    header('Location: /admin/productos');
                    exit;
                }

                $resultado = $producto->eliminar();
                if($resultado) {
                    header('Location: /admin/productos');
                    exit;
                } else {
                    echo "Hubo un error al eliminar el producto.";
                }
            }

            elseif (isset($_POST['eliminar_categoria'])) {
                $categoria = Categoria::find($id);

                if(!$categoria) {
                    header('Location: /admin/productos');
                    exit;
                }

                $productos = Producto::where('IDcategoria', $id);
                $nueva_categoria_id = 1;

                foreach ($productos as $producto) {
                    $producto->IDcategoria = $nueva_categoria_id;
                    $producto->guardar();
                }

                $resultado_categoria = $categoria->eliminar();
                if($resultado_categoria) {
                    header('Location: /admin/productos');
                    exit;
                } else {
                    echo "Hubo un error al eliminar la categoría.";
                }
            }
        }
    }

    public static function actualizar_inventario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            $producto = Producto::find($id);

            if ($producto) {
                $cantidad_flores_a_agregar = filter_var($_POST['cantidad_flores'], FILTER_VALIDATE_INT) ?? 0;
                $stock_a_agregar = filter_var($_POST['stock'], FILTER_VALIDATE_INT) ?? 0;

                $producto->cantidad_flores += $cantidad_flores_a_agregar;
                $producto->stock += $stock_a_agregar;

                $resultado = $producto->guardar();
                if ($resultado) {
                    header('Location: /admin/productos?mensaje=Inventario actualizado');
                }
            }
        }
    }
}
?>
