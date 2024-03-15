<?php

require_once

$uri = parse_url($_SERVER["REQUEST_URI"])['path'];

$routes = [
    '/' => 'Controllers/index.php',
    '/categories' => 'views/categories/categories.php',
    '/categories/create' => 'views/categories/create.php',
];

function routeToController($uri, $routes): void
{
    if(array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        var_dump($uri);
        die();
        abort();
    }
}

function abort($code = 404): void
{
    http_response_code($code);
    require 'views/errors/not-found.php';
    die();
}

routeToController($uri, $routes);