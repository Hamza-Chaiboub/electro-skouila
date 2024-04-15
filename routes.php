<?php

/**
 *
 * @var $router
 *
 * */

require root_path('Controllers/DatabaseConnection.php');
require root_path('Controllers/CategoryController.php');
require root_path('Controllers/ProductController.php');
require root_path('Controllers/HomeController.php');
require root_path('Controllers/AuthController.php');
require root_path('Core/Auth.php');
require root_path('Core/Errors.php');
require root_path('Core/Validator.php');
require root_path('Models/Model.php');
require root_path('Models/User.php');
require root_path('Models/Product.php');
require root_path('Models/Category.php');

$router->addRoute('GET', '/',HomeController::class, 'home');
$router->addRoute('GET', '/not-found', HomeController::class, 'notFound');


$router->addRoute('GET', '/categories',CategoryController::class, 'index');
$router->addRoute('GET', "/category/{id:\d+}",CategoryController::class, 'view');

if(Auth::authenticated() && Auth::isAdmin()) {
    $router->addRoute('GET', '/category/create',CategoryController::class, 'create');
    $router->addRoute('POST', '/category/create',CategoryController::class, 'store');
    $router->addRoute('GET', '/category/edit/{id:\d+}',CategoryController::class, 'edit');
    $router->addRoute('POST', '/category/edit/{id:\d+}',CategoryController::class, 'update');
    $router->addRoute('GET', '/category/delete/{id:\d+}',CategoryController::class, 'destroy');
}


if (Auth::authenticated()) {
    $router->addRoute('GET', '/profile/{id:\d+}/{username:\w+}',AuthController::class, 'view');
    $router->addRoute('POST', '/profile/{id:\d+}/{username:\w+}',AuthController::class, 'updateUser');
    $router->addRoute('GET', '/user/logout',AuthController::class, 'logout');
}

$router->addRoute('GET', '/login',AuthController::class, 'login');
$router->addRoute('POST', '/login',AuthController::class, 'authenticate');
$router->addRoute('GET', '/register',AuthController::class, 'register');
$router->addRoute('POST', '/register',AuthController::class, 'storeUser');


$router->addRoute('GET', '/products', ProductController::class, 'index');
$router->addRoute('GET', '/product/create', ProductController::class, 'create');
$router->addRoute('POST', '/product/create', ProductController::class, 'store');
$router->addRoute('GET', '/product/{id:\d+}/{slug:\w+}', ProductController::class, 'show');
$router->addRoute('GET', '/products/{id:\d+}', ProductController::class, 'showProductsFromCategory');