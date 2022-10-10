<?php




require_once 'vendor/autoload.php';


use Src\Controllers\CartController;
use Src\Controllers\StockController;
use Src\Controllers\VueController;
use Src\Router\Router;


$router = new Router();
$router->get('/' , VueController::class . '::index');
$router->get('/products' , StockController::class . '::products');
$router->get('/cart' , CartController::class . '::show');
$router->post('/addProduct' , StockController::class . '::store');
$router->post('/update' , StockController::class . '::update');
$router->post('/destroy' , StockController::class . '::destroy');
$router->get('/cart/products' , CartController::class . '::show');
$router->get('/cart/subtotal' , CartController::class . '::subtotal');
$router->get('/cart/vatAmount' , CartController::class . '::vatAmount');
$router->get('/cart/total' , CartController::class . '::total');
$router->post('/cart/buy' , CartController::class . '::buy');
$router->post('/cart/addProduct' , CartController::class . '::add');
$router->post('/cart/removeProduct' , CartController::class . '::remove');
$router->get('/cart' , CartController::class . '::show');
$router->get('/cart/subtotal' , CartController::class . '::subtotal');
$router->run();
