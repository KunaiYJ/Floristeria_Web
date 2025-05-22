<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\CategoriasController;
use Controllers\ClientePedidosController;
use Controllers\ClientesController;
use Controllers\DashboardController;
use Controllers\PaginasController;
use Controllers\PedidosController;
use Controllers\ProductosController;
use Controllers\ProveedoresController;
use Controllers\RegistradosController;
use Controllers\ReportesController;
use Controllers\VentasController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

//Administrador
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/registrados', [RegistradosController::class, 'index']);
$router->get('/admin/registrados/crear', [RegistradosController::class, 'crear']);
$router->post('/admin/registrados/crear', [RegistradosController::class, 'crear']);
$router->get('/admin/registrados/editar', [RegistradosController::class, 'editar']);
$router->post('/admin/registrados/editar', [RegistradosController::class, 'editar']);
$router->post('/admin/registrados/eliminar', [RegistradosController::class, 'eliminar']);

$router->get('/admin/clientes', [ClientesController::class, 'index']);
$router->get('/admin/clientes/crear', [ClientesController::class, 'crear']);
$router->post('/admin/clientes/crear', [ClientesController::class, 'crear']);
$router->get('/admin/clientes/editar', [ClientesController::class, 'editar']);
$router->post('/admin/clientes/editar', [ClientesController::class, 'editar']);
$router->post('/admin/clientes/eliminar', [ClientesController::class, 'eliminar']);

$router->get('/admin/productos', [ProductosController::class, 'index']);
$router->get('/admin/productos/crear', [ProductosController::class, 'crear']);
$router->post('/admin/productos/crear', [ProductosController::class, 'crear']);
$router->get('/admin/productos/editar', [ProductosController::class, 'editar']);
$router->post('/admin/productos/editar', [ProductosController::class, 'editar']);
$router->post('/admin/productos/eliminar', [ProductosController::class, 'eliminar']);
$router->post('/admin/productos/actualizar_inventario', [ProductosController::class, 'actualizar_inventario']);

$router->get('/admin/proveedores', [ProveedoresController::class, 'index']);
$router->get('/admin/proveedores/crear', [ProveedoresController::class, 'crear']);
$router->post('/admin/proveedores/crear', [ProveedoresController::class, 'crear']);
$router->get('/admin/proveedores/editar', [ProveedoresController::class, 'editar']);
$router->post('/admin/proveedores/editar', [ProveedoresController::class, 'editar']);
$router->post('/admin/proveedores/eliminar', [ProveedoresController::class, 'eliminar']);

$router->get('/admin/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/admin/categorias/crear', [CategoriasController::class, 'crear']);
$router->get('/admin/categorias/editar', [CategoriasController::class, 'editar']);
$router->post('/admin/categorias/editar', [CategoriasController::class, 'editar']);
$router->post('/admin/categorias/eliminar', [CategoriasController::class, 'eliminar']);

$router->get('/admin/pedidos', [PedidosController::class, 'index']);

$router->get('/admin/pedidos/crear', [PedidosController::class, 'crear']);
$router->post('/admin/pedidos/crear', [PedidosController::class, 'crear']);

$router->get('/admin/pedidos/editar', [PedidosController::class, 'editar']);
$router->post('/admin/pedidos/editar', [PedidosController::class, 'editar']);
$router->post('/admin/pedidos/eliminar', [PedidosController::class, 'eliminar']);
$router->get('/admin/pedidos/obtener_pedidos', [PedidosController::class, 'obtener_pedidos']);
$router->post('/admin/pedidos/actualizarEstado', [PedidosController::class, 'actualizarEstado']);

$router->get('/admin/reportes', [ReportesController::class, 'index']);
$router->get('/admin/reportes/generarPDF', [ReportesController::class, 'generarPDF']);

$router->get('/admin/ventas', [VentasController::class, 'index']);
$router->get('/admin/ventas/crear', [VentasController::class, 'crear']);
$router->post('/admin/ventas/vender', [VentasController::class, 'vender']);

// Area publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/categorias', [PaginasController::class, 'categorias']);
$router->get('/productos', [PaginasController::class, 'productos']);

$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

$router->get('/Cpedidos', [PaginasController::class, 'pedidos']);
$router->get('/Cpedidos/crearPedido', [PaginasController::class, 'crearPedido']);
$router->post('/Cpedidos/crearPedido', [PaginasController::class, 'crearPedido']);


// Pagina de 404
$router->get('/404', [PaginasController::class, 'error']);

$router->comprobarRutas();