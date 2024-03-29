<?php

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . 'Core/functions.php';

$uri = $_SERVER["REQUEST_URI"];

require root_path('Core/MyRouter.php');
$router = new MyRouter();

$routes = require root_path('routes.php');

$router->matchRoute($uri);

DatabaseConnection::closeConnection();