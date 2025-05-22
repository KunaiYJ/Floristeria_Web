<?php

namespace Controllers;

use Model\Cliente;
use Model\Pedido;
use Model\Producto;
use Model\Proveedor;
use Model\Usuarios;
use Model\Venta;
use MVC\Router;

class DashboardController {

    public static function index(Router $router) {
        $totalRegistrados = Usuarios::total();
        $totalClientes = Cliente::total();
        $totalProductos = Producto::total();
        $totalProveedores = Proveedor::total();
        $totalPedidos = Pedido::total();
        $totalVentas = Venta::total();


        $router->render('admin/dashboard/index', [
            'totalRegistrados' => $totalRegistrados,
            'totalClientes' => $totalClientes,
            'totalProductos' => $totalProductos,
            'totalProveedores' => $totalProveedores,
            'totalPedidos' => $totalPedidos,
            'totalVentas' => $totalVentas,
            'titulo' => 'Administrativo'
        ]);
    }

}


?>