<?php

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . 'Core/functions.php';

$uri = $_SERVER["REQUEST_URI"];

require root_path('Core/MyRouter.php');
require root_path('Controllers/DatabaseConnection.php');
require root_path('Controllers/CategoryController.php');
require root_path('Controllers/HomeController.php');
$router = new MyRouter();

$routes = require root_path('routes.php');

$router->matchRoute($uri);

DatabaseConnection::closeConnection();