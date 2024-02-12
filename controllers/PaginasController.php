<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades',[
            'propiedades'=>$propiedades
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');
        //buscar la propiedad por su id
        $propeidad = Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad' => $propeidad
        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router){
        $mensaje = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];
            //Crear instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '2f6d45c1a97c86';
            $mail->Password = '228466d0d1b910';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 465;

            //Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com','BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] .'</p>';            
            //Enviar de forma de forma condicional algunos campos de email o telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Prefiere ser contactado por: Telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] .'</p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['fecha'] .'</p>';
                $contenido .= '<p>Hora Contacto: ' . $respuestas['hora'] .'</p>';
            }else{
                //Es email 
                $contenido .= '<p>Prefiere ser contactado por: EMail</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] .'</p>';                
            }
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] .'</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] .'</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] .'</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Texto Alternativo Sin HTML';

            //Enviar el email
            if ($mail->send()) {
                $mensaje =  'Mensaje Enviado Correctamente';
            }else{
                $mensaje =  'El Mensaje o se pudo enviar';
            }
        }
        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }

}