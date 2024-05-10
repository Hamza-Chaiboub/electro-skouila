<?php

/**
 *
 * @var $router
 *
 * */

use Controllers\AdminController;
use Controllers\CartController;
use Controllers\CategoryController;
use Controllers\HomeController;
use Controllers\OrderController;
use Controllers\ProductController;
use Controllers\UserController;
use Core\Auth;

$router->addRoute('GET', '/',HomeController::class, 'home');
$router->addRoute('GET', '/404', HomeController::class, 'notFound');


$router->addRoute('GET', '/categories',CategoryController::class, 'index');
$router->addRoute('GET', "/category/{id:\d+}/{slug:\w+}",CategoryController::class, 'view');

if(Auth::authenticated() && Auth::isAdmin()) {
    $router->addRoute('GET', '/category/create',CategoryController::class, 'create');
    $router->addRoute('POST', '/category/create',CategoryController::class, 'store');
    $router->addRoute('GET', '/category/edit/{id:\d+}',CategoryController::class, 'edit');
    $router->addRoute('POST', '/category/edit/{id:\d+}',CategoryController::class, 'update');
    $router->addRoute('GET', '/category/delete/{id:\d+}',CategoryController::class, 'destroy');
    $router->addRoute('GET', '/product/create', ProductController::class, 'create');
    $router->addRoute('POST', '/product/create', ProductController::class, 'store');
    $router->addRoute('GET', '/product/edit/{id:\d+}/{slug:\w+}', ProductController::class, 'edit');
    $router->addRoute('POST', '/product/edit/{id:\d+}/{slug:\w+}', ProductController::class, 'update');
    $router->addRoute('GET', '/dashboard', AdminController::class, 'home');
}


if (Auth::authenticated()) {
    $router->addRoute('GET', '/profile/{id:\d+}/{username:\w+}',UserController::class, 'view');
    $router->addRoute('POST', '/profile/{id:\d+}/{username:\w+}',UserController::class, 'updateUser');
    $router->addRoute('GET', '/user/logout',UserController::class, 'logout');
}

$router->addRoute('GET', '/login',UserController::class, 'login');
$router->addRoute('POST', '/login',UserController::class, 'authenticate');
$router->addRoute('GET', '/register',UserController::class, 'register');
$router->addRoute('POST', '/register',UserController::class, 'storeUser');


//$router->addRoute('GET', '/products', ProductController::class, 'index');
$router->addRoute('GET', '/product/{id:\d+}/{slug:\w+}', ProductController::class, 'show');
$router->addRoute('GET', '/products/{id:\d+}', ProductController::class, 'showProductsFromCategory');
$router->addRoute('GET', '/products', ProductController::class, 'paginate');
$router->addRoute('GET', '/products/page', ProductController::class, 'paginate');
$router->addRoute('GET', '/products/page/{page:\d+}', ProductController::class, 'paginate');



$router->addRoute('GET', '/orders/{user_id:\d+}', OrderController::class, 'getOrders');
$router->addRoute('POST', '/addToCart/{id:\d+}', CartController::class, 'addToCart');
$router->addRoute('GET', '/increment/{id:\d+}', CartController::class, 'increment');
$router->addRoute('GET', '/decrement/{id:\d+}', CartController::class, 'decrement');
$router->addRoute('GET', '/removeFromCart/{id:\d+}', CartController::class, 'removeFromCart');