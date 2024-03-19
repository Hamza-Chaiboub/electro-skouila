<?php

var_dump(date("c"));
die();


$uri = $_SERVER["REQUEST_URI"];

require_once 'Core/MyRouter.php';
require_once 'Controllers/DatabaseConnection.php';
require_once 'Controllers/CategoryController.php';
require_once 'Controllers/HomeController.php';
$router = new MyRouter();

$routes = require 'routes.php';

$router->matchRoute($uri);

DatabaseConnection::closeConnection();