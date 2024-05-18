<?php
const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "vendor/autoload.php";
require_once BASE_PATH . 'vendor/dompdf/autoload.inc.php';

use Core\MyRouter;
use Core\DatabaseConnection;


require BASE_PATH . 'Core/functions.php';

$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];

$router = new MyRouter();

$routes = require root_path('routes.php');

setSession();

// Testing purposes

// End testing

$router->matchRoute($uri, $method);

DatabaseConnection::closeConnection();