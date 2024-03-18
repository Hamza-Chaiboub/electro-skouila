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

/*$router->get('/', 'Controllers/index.php');
//$router->get('/categories', 'views/categories/categories.php');
//$router->get('/categories', 'views/categories/categories.php');
//$router->get('/categories/create', 'views/categories/create.php');
//$router->get('/category', 'views/categories/view.php');
//$router->get('/category/edit', 'views/categories/edit.php');
//$router->get('/category/delete', 'views/categories/delete.php');

//$router->post('/categories/create', 'views/categories/create.php');


/*$router->get($uri, $controller, $method, $args);*/

$router->addRoute('GET', '/','HomeController', 'index');




$router->addRoute('GET', '/categories','CategoryController', 'index');
$router->addRoute('GET', "/category/{id:\d+}",'CategoryController', 'view');
$router->addRoute('GET', '/category/create','CategoryController', 'create');
$router->addRoute('GET', '/category/edit/{id:\d+}','CategoryController', 'edit');
$router->addRoute('GET', '/category/delete/{id:\d+}','CategoryController', 'destroy');