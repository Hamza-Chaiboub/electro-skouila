<?php
//require('Core/Router.php');
//
$uri = $_SERVER["REQUEST_URI"];
//$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];
//
//$router = new Router();
//
//$routes = require('routes.php');
//
//$router->route($uri, $method);

require_once 'Core/MyRouter.php';
require_once 'Controllers/DatabaseConnection.php';
require_once 'Controllers/CategoryController.php';
require_once 'Controllers/HomeController.php';
$router = new MyRouter();


/*$router->addRoute('GET', '/', function() {
    require 'Controllers/index.php';
});

$router->addRoute('GET', '/categories', function() {
    require 'views/categories/categories.php';
});*/

$routes = require 'routes.php';


//echo '<pre>', print_r($matches, true), '</pre>';

$router->matchRoute($uri);