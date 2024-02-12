<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    //INDEX
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = null;
        $resultado = $_GET['resultado'] ?? null;
        $router->render('propiedades/admin',[
            'propiedades'=> $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }


    //CREAR
    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Crea instancia
            $propiedad = new Propiedad($_POST['propiedad']);
            
            //Generar nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Setear la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                //Realiza resize a la imagen con intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }

            //Arreglo errores iniciado
            $errores = $propiedad->validar();
            
            //Revisar el arreglo de errores
            if (empty($errores)) {
                //Crear carpeta para imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                /* Subida de archivos */
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $resultado = $propiedad->guardar();
            }
        }
        $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    //ACTUALIZAR
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        //METODO POST PARA ACTUALIZAR
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
    
            $errores = $propiedad->validar();
    
            //Generar nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            
            //Setear la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                //Realiza resize a la imagen con intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
             }
    
            //Revisar el arreglo de errores
            if (empty($errores)) {
                //Almacenar la imagen
                if (isset($image)) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                $resultado = $propiedad->guardar();          
            }     
        }
        $router->render('propiedades/actualizar',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    //ELIMINAR
    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {            
                 $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) { 
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}