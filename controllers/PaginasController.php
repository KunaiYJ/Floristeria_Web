<?php

namespace Controllers;
use MVC\Router;
use Model\Producto;
use Model\Usuarios;
use Model\TipoDeEnvio;
use Model\PedidoUsuarios;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $productos = Producto::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'productos' => $productos
        ]);
    }

    public static function nosotros(Router $router) {

        $router->render('paginas/nosotros', [
            'titulo' => 'Nosotros Como Empresa en Agua Prieta'
        ]);
    }

    public static function categorias(Router $router) {

        $router->render('paginas/categorias', [
            'titulo' => 'Categorias De Productos'
        ]);
    }

    public static function productos(Router $router) {
        $productos = Producto::all();

        $router->render('paginas/productos', [
            'titulo' => 'Productos',
            'productos' => $productos
        ]);
    }

    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            
            // Crear una nueva instancia
            $mail = new PHPMailer();

            // COnfigurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = '51ff26a8060912';
            $mail->Password = '41387b64d852b3';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 465;

            // Configurar el contenido del email
            $mail->setFrom('m.fernanda@floristeria.com');
            $mail->addAddress('m.fernanda@floristeria.com', 'LaFloristeria.com');
            $mail->Subject = '~ CLIENTES FLORISTERIA (CONTACTO) ~';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>* NUEVO MENSAJE *</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            // Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>-- ELIGIO SER CONTACTADO POR TELEFONO --</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha para Contactar: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora para Contactar: ' . $respuestas['hora'] . '</p>';
            } else {
                // Es email, entonces agreamos el campo de email
                $contenido .= '<p>-- ELIGIO SER CONTACTADO POR CORRECTO --</p>';
                $contenido .= '<p>Correo: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el email
            if($mail->send()) {
                $mensaje = "Mensaje Enviado Correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }

        }

        $router->render('paginas/contacto', [
            'titulo' => 'Contacto Clientes',
            'mensaje' => $mensaje
        ]);
    }

    //Pedidos desde usuarios
    public static function pedidos(Router $router) {
        $tiposDeEnvio = TipoDeEnvio::all();

        $router->render('paginas/Cpedidos/index', [
            'titulo' => 'Encarga tu Ramo',
            'tiposDeEnvio' => $tiposDeEnvio
        ]);
    }

    public static function crearPedido(Router $router) {

        $alertas = [];
        $pedido = new PedidoUsuarios();
        $usuarios = Usuarios::all();
        $tiposDeEnvio = TipoDeEnvio::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $pedido->sincronizar($_POST);
            $alertas = $pedido->validar();

            
            if(empty($alertas)) {
                $resultado = $pedido->guardar();

                if($resultado) {
                    header('Location: /Cpedidos');
                }
            }
        }

        $router->render('paginas/Cpedidos/crearPedido', [
            'titulo' => 'Registra tu Pedido',
            'alertas' => $alertas,
            'pedido' => $pedido,
            'usuarios' => $usuarios,
            'tiposDeEnvio' => $tiposDeEnvio
        ]);
    }

    public static function error(Router $router) {

        $router->render('paginas/error', [
            'titulo' => 'Pagina no encontrada'
        ]);
    }
}

?>