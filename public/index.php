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
//$array = ["email" => "test1@skouila.com"];
//dd(array_key_first($array));
//dd(User::findBy(["email" => "test1@skouila.com"]));
// End testing

$router->matchRoute($uri, $method);

DatabaseConnection::closeConnection();