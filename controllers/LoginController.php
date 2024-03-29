<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController{
    public static function login(Router $router){
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                //Verificar si existe el usuario
                $resultado = $auth->existeUsuaio();
                if (!$resultado) {
                    $errores = Admin::getErrores();
                }else{
                    //Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    //Autenticar al usuario
                    if ($autenticado) {
                        $auth->autenticar();
                    }else{
                        //Password incorrecto
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        $router->render('auth/login',[
            'errores' => $errores
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}