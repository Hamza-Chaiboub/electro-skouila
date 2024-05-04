<?php
const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . 'Core/functions.php';

$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];

require root_path('Core/MyRouter.php');
$router = new MyRouter();

$routes = require root_path('routes.php');

setSession();

// Testing purposes
//dd(Product::paginate(["start" => 1 , "limit" => 3]));
// End testing

$router->matchRoute($uri, $method);

DatabaseConnection::closeConnection();