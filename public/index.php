<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Model\Vendedor;
use Controllers\PaginasController;

$router = new Router();
//PROPIEDAD ROUTING
$router->get('/admin',[PropiedadController::class, 'index']);
$router->get('/propiedades/crear',[PropiedadController::class, 'crear']);
$router->post('/propiedades/crear',[PropiedadController::class, 'crear']);
$router->post('/propiedades/eliminar',[PropiedadController::class, 'eliminar']);
$router->post('/propiedades/actualizar',[PropiedadController::class, 'actualizar']);
$router->get('/propiedades/actualizar',[PropiedadController::class, 'actualizar']);

//VENDEDOR ROUTING
$router->get('/vendedores/crear',[VendedorController::class, 'crear']);
$router->post('/vendedores/crear',[VendedorController::class, 'crear']);
$router->post('/vendedores/eliminar',[VendedorController::class, 'eliminar']);
$router->post('/vendedores/actualizar',[VendedorController::class, 'actualizar']);
$router->get('/vendedores/actualizar',[VendedorController::class, 'actualizar']);


//Paginas
$router->get('/',[PaginasController::class,'index']);
$router->get('/nosotros',[PaginasController::class,'nosotros']);
$router->get('/propiedades',[PaginasController::class,'propiedades']);
$router->get('/propiedad',[PaginasController::class,'propiedad']);
$router->get('/blog',[PaginasController::class,'blog']);
$router->get('/entrada',[PaginasController::class,'entrada']);
$router->get('/contacto',[PaginasController::class,'contacto']);
$router->post('/contacto',[PaginasController::class,'contacto']);

//Login y Autenticacion
$router->get('/login', [LoginController::class,'login']);
$router->post('/login', [LoginController::class,'login']);
$router->get('/logout', [LoginController::class,'logout']);

$router->comprobarRutas();