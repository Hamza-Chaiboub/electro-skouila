<?php
const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "vendor/autoload.php";
require_once BASE_PATH . 'vendor/dompdf/autoload.inc.php';

use Core\MyRouter;

require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'Core/kernel.php';

$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];

$router = new MyRouter();


if(isApi($uri)){
    $routes = require root_path('api_routes.php');
} else {
    $routes = require root_path('routes.php');
}

setSession();

// Testing purposes
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->safeLoad();
//dd($_ENV);
//dd(getenv('APP_NAME'));
// End testing

$router->matchRoute($uri, $method);