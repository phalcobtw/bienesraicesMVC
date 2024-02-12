<?php

    define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');


    function incluirTemplate($nombre, $inicio = false){
        include TEMPLATES_URL . "/{$nombre}.php";
    }

    function esAutentificado(){
    //Verificar Login
    session_start();
    if (!$_SESSION['login']) {
        header('Location: /');
    }
    
    }

    function debuguear($variable){
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
    }


    //Sanitizar HTML
    function s($html) : string{
        $s = htmlspecialchars($html);
        return $s;
    }


    //Validar tipo de contenido
    function validarTipoContenido($tipo){
        $tipos = ['vendedor','propiedad'];
        return in_array($tipo,$tipos);
    }

    //Muestra mensajes
    function mostrarNotificacion($codigo){
        $mensaje = '';
        switch($codigo){
            case 1:
                $mensaje = 'Creado Correctamente';
                break;
            
            case 2:
                $mensaje = 'Actualizado Correctamente';
                break;

            case 3:
                $mensaje = 'Eliminado Correctamente';
                break;

            default:
            $mensaje = false;
            break;
        }
        return $mensaje;
    }


    function validarORedireccionar(string $url){
        $id = $_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);

        if(!$id){
            header("Location: {$url}");
        }

        return $id;
    }