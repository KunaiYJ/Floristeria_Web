<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Model\Cliente;
use Model\Usuarios;
use Model\TipoDeEnvio;
use Classes\Paginacion;
use Model\PedidoUsuarios;

class PedidosController {

    public static function index(Router $router) {
        // Obtener la página actual de la consulta
        $pagina_actual = $_GET['page'] ?? 1; 
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/pedidos?page=1');
            exit;
        }
        
        $por_pagina = 5;
        $total = Pedido::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);
    
        // Obtén los pedidos de acuerdo a la paginación
        $pedidosUsuario = PedidoUsuarios::paginar($por_pagina, $paginacion->offset());
        $pedidos = Pedido::paginar($por_pagina, $paginacion->offset());
        $todosLosPedidos = array_merge($pedidos, $pedidosUsuario);
        
        $router->render('admin/pedidos/index', [
            'titulo' => 'Pedidos Actuales',
            'pedidos' => $todosLosPedidos,
            'clientes' => Cliente::all(),
            'usuarios' => Usuarios::all(),
            'pedido' => !empty($pedidos) ? $pedidos[0] : null,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $pedido = new Pedido();
        $clientes = Cliente::all();
        $tiposDeEnvio = TipoDeEnvio::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

            $pedido->sincronizar($_POST);
            $alertas = $pedido->validar();

            
            if(empty($alertas)) {
                $resultado = $pedido->guardar();

                if($resultado) {
                    header('Location: /admin/pedidos');
                }
            }
        }

        $router->render('admin/pedidos/crear', [
            'titulo' => 'Registrar Pedido',
            'alertas' => $alertas,
            'pedido' => $pedido,
            'clientes' => $clientes,
            'tiposDeEnvio' => $tiposDeEnvio
        ]);
    }

    public static function editar(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
        }
    
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: /admin/pedidos');
        }
    
        $alertas = [];
        $pedido = Pedido::find($id);
        $clientes = Cliente::all();
        $tiposDeEnvio = TipoDeEnvio::all();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedido->sincronizar($_POST);
            $alertas = $pedido->validar();
            
            if (empty($alertas)) {
                $resultado = $pedido->guardar();
                if ($resultado) {
                    header('Location: /admin/pedidos');
                }
            }
        }
    
        $router->render('admin/pedidos/editar', [
            'titulo' => 'Actualizar Pedido',
            'alertas' => $alertas,
            'pedido' => $pedido,
            'clientes' => $clientes,
            'tiposDeEnvio' => $tiposDeEnvio
        ]);
    }

    public  static function eliminar() {
        if(!is_admin()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

            $id = $_POST['id'];
            $pedido = Pedido::find($id);

            if(!isset($producto)) {
                header('Location: /admin/pedidos');
            }

            $resultado = $pedido->eliminar();

            if($resultado) {
                header('Location: /admin/pedidos');
            }
        }

    }

    public static function obtener_pedidos() {
        $pedidos = Pedido::all();
        $pedidosUsuario = PedidoUsuarios::all();
        
        $eventos = [];
        
        foreach ($pedidos as $pedido) {
            if ($pedido->estado !== 'Terminado') {
                $cliente = Cliente::find($pedido->IDcliente);
                $nombreCompleto = $cliente ? $cliente->nombre : 'No especificado';
        
                $eventos[] = [
                    'id' => $pedido->IDpedido,
                    'title' => $pedido->producto,
                    'start' => $pedido->fecha,
                    'extendedProps' => [
                        'cliente' => $nombreCompleto,
                        'estado' => $pedido->estado,
                        'direccion' => $pedido->direccion,
                        'contacto' => $pedido->contacto,
                        'tipo' => 'pedido' // Añadir tipo de pedido
                    ],
                ];
            }
        }
        
        foreach ($pedidosUsuario as $pedidoUsuario) {
            if ($pedidoUsuario->estado !== 'Terminado') {
                $usuario = Usuarios::find($pedidoUsuario->usuarioID);
                $nombreCompleto = $usuario ? $usuario->nombre . ' ' . $usuario->apellido : 'No especificado';
        
                $eventos[] = [
                    'id' => $pedidoUsuario->IDpedidoCliente,
                    'title' => $pedidoUsuario->producto,
                    'start' => $pedidoUsuario->fecha,
                    'extendedProps' => [
                        'cliente' => $nombreCompleto,
                        'estado' => $pedidoUsuario->estado,
                        'direccion' => $pedidoUsuario->direccion,
                        'contacto' => $pedidoUsuario->contacto,
                        'tipo' => 'pedidoUsuario' // Añadir tipo de pedidoUsuario
                    ],
                ];
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($eventos);
        exit;
    }

    public static function actualizarEstado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            $estado = $_POST['estado'];
            
            if ($id && $estado) {
                // Intentar encontrar el pedido en la tabla Pedido
                $pedido = Pedido::find($id);
                
                if ($pedido) {
                    // Solo actualizamos el estado si encontramos el pedido en la tabla Pedido
                    $pedido->estado = $estado;
                    $resultado = $pedido->guardar();
                    
                    if (isset($resultado) && $resultado) {
                        header('Content-Type: application/json');
                        echo json_encode(['success' => true]);
                        exit;
                    }
                }
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(['success' => false]);
        exit;
    }   
}


?>