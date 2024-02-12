<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        //Asocia un nombre de funcion a la url indicada
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn){
        //Asocia un nombre de funcion a la url indicada
        $this->rutasPOST[$url] = $fn;
    }
 
    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;
        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/crear','propiedades/actualizar','/propiedades/eliminar','/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            //Obtiene la funcion asociada a la url de la pagina actual
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            //Obtiene la funcion asociada a la url de la pagina actual
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) {
            //La URL Existe y tiene funcion asociada
            call_user_func($fn, $this);
        }else{
            echo 'Pagina no encontrada';
        }
    }

    //Muestra una vista
    public function render($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start(); //Almacenamiento en memoria durante un momento
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //Libera el contenido de la memoria (Limpia el buffer)

        include __DIR__ . "/views/layout.php";
    }
}