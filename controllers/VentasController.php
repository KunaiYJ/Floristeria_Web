<?php

namespace Controllers;

use MVC\Router;
use Model\Venta;
use Model\Cliente;
use Model\Producto;
use Model\Categoria;

class VentasController {

    public static function index(Router $router) {
        $productos = Producto::all();
        $clientes = Cliente::all();
        $categorias = Categoria::all();

        $titulo = "Ventas";

        $router->render('admin/ventas/index', [
            'titulo' => $titulo,
            'productos' => $productos,
            'clientes' => $clientes,
            'categorias' => $categorias
        ]);
    }

    public static function vender(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
    
            $clienteId = $data['clienteID'];
            $productos = $data['productos'];
            $total = $data['total'];
        
            $alertas = []; // Array para almacenar las alertas
        
            foreach ($productos as $productoId => $producto) {
                // Buscar el producto para verificar stock
                $productoEnBase = Producto::find($productoId);
                
                // Verificar si hay suficiente stock
                if ($productoEnBase->stock < $producto['cantidad']) {
                    $alertas['error'][] = "Stock insuficiente para {$productoEnBase->nombreProducto}. Disponible: {$productoEnBase->stock}, solicitado: {$producto['cantidad']}.";
                    continue;
                }
    
                // Crear la instancia de la venta
                $venta = new Venta([
                    'ProductoID' => $productoId,
                    'ClienteID' => $clienteId,
                    'cantidad' => $producto['cantidad'],
                    'total' => $producto['precio'] * $producto['cantidad']
                ]);
    
                // Validar la venta y almacenar alertas si hay
                $alertas = array_merge($alertas, $venta->validar());
                if (empty($alertas['error'])) {
                    $venta->guardar(); // Guardar la venta en la base de datos
                    $productoEnBase->reducirStock($producto['cantidad']); // Reducir el stock del producto vendido
                }
            }
    
            // Verifica si hay alertas
            if (!empty($alertas['error'])) {
                http_response_code(400); // Código de respuesta 400 para errores
                echo json_encode(['error' => $alertas['error']]);
                exit;
            }
    
            // Responder con éxito si no hay errores
            http_response_code(200);
            echo json_encode(['mensaje' => 'Venta registrada con éxito y stock actualizado']);
            exit;
        }
    }    
}


?>