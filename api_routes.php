<?php

/**
 *
 * @var $router
 *
 * */

use Controllers\ProductController;
use Controllers\UserController;

$router->addRoute('GET', '/api/auth',UserController::class, 'authApi');
$router->addRoute('POST', '/api/auth/login',UserController::class, 'fetchAuth');
$router->addRoute('GET', '/api/auth/getData',UserController::class, 'fetchData');
$router->addRoute('GET', '/api/products/get',ProductController::class, 'fetchProducts');
//$router->addRoute('OPTIONS', '/api/auth/login',UserController::class, 'fetchAuth');