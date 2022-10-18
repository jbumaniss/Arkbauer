<?php




require_once 'vendor/autoload.php';


use Src\Controllers\CartController;
use Src\Controllers\StockController;
use Src\Controllers\VueController;
use Src\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$router = new Router();
$router->get('/' , VueController::class . '::index');

$router->get('/products' , StockController::class . '::index');
$router->post('/create' , StockController::class . '::store');
$router->post('/update' , StockController::class . '::update');
$router->post('/destroy' , StockController::class . '::destroy');


$router->get('/cart/products' , CartController::class . '::index');
$router->post('/cart/create' , CartController::class . '::store');
$router->post('/cart/destroy' , CartController::class . '::destroy');

$router->get('/cart/subtotal' , CartController::class . '::subtotal');
$router->get('/cart/vatAmount' , CartController::class . '::vatAmount');
$router->get('/cart/total' , CartController::class . '::total');
$router->post('/cart/buy' , CartController::class . '::buy');

$router->run();
