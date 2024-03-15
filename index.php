<?php
require('Core/Router.php');

$uri = parse_url($_SERVER["REQUEST_URI"])['path'];
$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];

$router = new Router();

$routes = require('routes.php');

$router->route($uri, $method);