<?php

namespace Controllers;

use MVC\Router;
use Model\Venta;
use Model\Producto;
use Model\Categoria;
use Model\Pedido; // Asegúrate de incluir el modelo de Pedido
use Model\Cliente; // Asegúrate de incluir el modelo de Cliente

class ReportesController {

    public static function index(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }

        $router->render('admin/reportes/index', [
            'titulo' => 'Reportes Generales'
        ]);
    }

    public static function generarPDF(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }
    
        $tipo = $_GET['tipo'] ?? null;
        $fechaInicio = $_GET['fechaInicio'] ?? null;
        $fechaFin = $_GET['fechaFin'] ?? null;
    
        if (!$tipo || !in_array($tipo, ['ventas', 'productos', 'pedidos'])) {
            header('Location: /admin/reportes');
            exit;
        }
    
        // Si el tipo es ventas o pedidos, asegurarse de que las fechas estén presentes
        if (($tipo === 'ventas' || $tipo === 'pedidos') && (!$fechaInicio || !$fechaFin)) {
            header('Location: /admin/reportes');
            exit;
        }
    
        require_once __DIR__ . '/../views/fpdf/fpdf.php';
    
        $pdf = new \FPDF('L');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Reporte de ' . ucfirst($tipo), 0, 1, 'C');
        $pdf->Ln(10);
    
        // Cabeceras de columnas
        $pdf->SetFont('Arial', 'B', 12);
        $totalWidth = 20 + 30 + 60 + 50 + 30 + 30;
        $startX = ($pdf->GetPageWidth() - $totalWidth) / 2;
    
        switch ($tipo) {
            case 'ventas':
                $pdf->Image('../src/img/Logo.png', 10, 8, 25, 25);
                $pdf->SetX($startX);
                $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Fecha', 1, 0, 'C');
                $pdf->Cell(60, 10, 'Descripcion', 1, 0, 'C');
                $pdf->Cell(50, 10, 'Cliente', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Total', 1, 1, 'C');
    
                $ventas = Venta::all();
                foreach ($ventas as $venta) {
                    if (strtotime($venta->fecha) < strtotime($fechaInicio) || strtotime($venta->fecha) > strtotime($fechaFin)) {
                        continue;
                    }
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->SetX($startX);
                    $pdf->Cell(20, 10, $venta->IDventa, 1, 0, 'C');
                    $pdf->Cell(30, 10, date('Y-m-d', strtotime($venta->fecha)), 1, 0, 'C');
                    $producto = Producto::find($venta->ProductoID);
                    $nombreProducto = $producto ? $producto->nombreProducto : 'Desconocido';
                    $pdf->Cell(60, 10, $nombreProducto, 1, 0, 'C');
                    $cliente = Cliente::find($venta->ClienteID);
                    $nombreCliente = $cliente ? $cliente->nombre : 'Desconocido';
                    $pdf->Cell(50, 10, $nombreCliente, 1, 0, 'C');
                    $pdf->Cell(30, 10, $venta->cantidad, 1, 0, 'C');
                    $pdf->Cell(30, 10, '$' . number_format($venta->total, 2), 1, 1, 'C');
                }
                break;
    
            case 'pedidos':
                $pdf->Image('../src/img/Logo.png', 10, 8, 25, 25);
                $pdf->SetX($startX);
                $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Fecha', 1, 0, 'C');
                $pdf->Cell(60, 10, 'Cliente', 1, 0, 'C');
                $pdf->Cell(80, 10, 'Descripcion', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Cantidad', 1, 1, 'C');
    
                $pedidos = Pedido::all();
                foreach ($pedidos as $pedido) {
                    if (strtotime($pedido->fecha) < strtotime($fechaInicio) || strtotime($pedido->fecha) > strtotime($fechaFin)) {
                        continue;
                    }
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->SetX($startX);
                    $pdf->Cell(20, 10, $pedido->IDpedido, 1, 0, 'C');
                    $pdf->Cell(30, 10, date('Y-m-d', strtotime($pedido->fecha)), 1, 0, 'C');
                    $cliente = Cliente::find($pedido->IDcliente);
                    $nombreCliente = $cliente ? $cliente->nombre : 'Desconocido';
                    $pdf->Cell(60, 10, $nombreCliente, 1, 0, 'C');
                    $pdf->Cell(80, 10, $pedido->descripcionPedido, 1, 0, 'C');
                    $pdf->Cell(30, 10, $pedido->cantidad, 1, 1, 'C');
                }
                break;
    
                case 'productos':
                    $pdf->Image('../src/img/Logo.png', 10, 8, 25, 25);
                    $pdf->SetX($startX);
                    $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
                    $pdf->Cell(65, 10, 'Nombre', 1, 0, 'C');
                    $pdf->Cell(40, 10, 'Categoria', 1, 0, 'C');
                    $pdf->Cell(30, 10, 'Stock', 1, 0, 'C');
                    $pdf->Cell(30, 10, 'Precio', 1, 0, 'C');
                    $pdf->Cell(30, 10, 'Fecha', 1, 1, 'C');
                
                    $productos = Producto::all();
                    foreach ($productos as $producto) {
                        // Obtener el nombre de la categoría a partir del ID de categoría
                        $categoria = Categoria::find($producto->IDcategoria);
                        $nombreCategoria = $categoria ? $categoria->nombre : 'Desconocida'; // Asegúrate de que 'nombreCategoria' es el campo correcto
                
                        $pdf->SetX($startX);
                        $pdf->Cell(20, 10, $producto->IDproducto, 1, 0, 'C');
                        $pdf->Cell(65, 10, $producto->nombreProducto, 1, 0, 'C');
                        $pdf->Cell(40, 10, $nombreCategoria, 1, 0, 'C'); // Mostrar el nombre de la categoría
                        $pdf->Cell(30, 10, $producto->stock, 1, 0, 'C');
                        $pdf->Cell(30, 10, '$' . number_format($producto->precio, 2), 1, 0, 'C');
                        $pdf->Cell(30, 10, date('Y-m-d', strtotime($producto->fecha)), 1, 1, 'C');
                    }
                    break;                
        }
    
        $pdf->Output();
        exit;
    }    
}
?>
