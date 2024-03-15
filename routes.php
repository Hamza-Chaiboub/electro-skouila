<?php

/*return [
    '/' => 'Controllers/index.php',
    '/categories' => 'views/categories/categories.php',
    '/categories/create' => 'views/categories/create.php',
];*/

/**
 *
 * @var $router
 *
 * */

$router->get('/', 'Controllers/index.php');
//$router->get('/categories', 'views/categories/categories.php');
$router->get('/categories', 'views/categories/categories.php');
$router->get('/categories/create', 'views/categories/create.php');
$router->get('/category', 'views/categories/view.php');
$router->get('/category/edit', 'views/categories/edit.php');
$router->get('/category/delete', 'views/categories/delete.php');

$router->post('/categories/create', 'views/categories/create.php');


//$router->get($uri, $controller, $method, $args);