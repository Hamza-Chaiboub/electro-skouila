<?php

/**
 *
 * @var $router
 *
 * */

require root_path('Controllers/DatabaseConnection.php');
require root_path('Controllers/CategoryController.php');
require root_path('Controllers/HomeController.php');
require root_path('Controllers/AuthController.php');

$router->addRoute('GET', '/','HomeController', 'index');


$router->addRoute('GET', '/categories',CategoryController::class, 'index');
$router->addRoute('GET', "/category/{id:\d+}",CategoryController::class, 'view');
$router->addRoute('GET', '/category/create',CategoryController::class, 'create');
$router->addRoute('GET', '/category/edit/{id:\d+}',CategoryController::class, 'edit');
$router->addRoute('POST', '/category/edit/{id:\d+}',CategoryController::class, 'update');
$router->addRoute('GET', '/category/delete/{id:\d+}',CategoryController::class, 'destroy');


$router->addRoute('GET', '/profile/{id:\d+}/{username:\w+}',AuthController::class, 'view');
$router->addRoute('GET', '/login',AuthController::class, 'login');
$router->addRoute('POST', '/login',AuthController::class, 'authenticate');
$router->addRoute('GET', '/register',AuthController::class, 'register');
$router->addRoute('POST', '/register',AuthController::class, 'storeUser');
$router->addRoute('GET', '/user/logout',AuthController::class, 'logout');