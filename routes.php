<?php

/**
 *
 * @var $router
 *
 * */

require root_path('Core/DatabaseConnection.php');
require root_path('Controllers/CategoryController.php');
require root_path('Controllers/ProductController.php');
require root_path('Controllers/HomeController.php');
require root_path('Controllers/UserController.php');
require root_path('Controllers/AdminController.php');
require root_path('Controllers/OrderController.php');
require root_path('Core/Auth.php');
require root_path('Core/Errors.php');
require root_path('Core/Validator.php');
require root_path('Models/Model.php');
require root_path('Models/User.php');
require root_path('Models/Product.php');
require root_path('Models/Category.php');
require root_path('Models/Order.php');
require root_path('Components/dashboard/Card.php');

$router->addRoute('GET', '/',HomeController::class, 'home');
$router->addRoute('GET', '/404', HomeController::class, 'notFound');


$router->addRoute('GET', '/categories',CategoryController::class, 'index');
$router->addRoute('GET', "/category/{id:\d+}",CategoryController::class, 'view');

if(Auth::authenticated() && Auth::isAdmin()) {
    $router->addRoute('GET', '/category/create',CategoryController::class, 'create');
    $router->addRoute('POST', '/category/create',CategoryController::class, 'store');
    $router->addRoute('GET', '/category/edit/{id:\d+}',CategoryController::class, 'edit');
    $router->addRoute('POST', '/category/edit/{id:\d+}',CategoryController::class, 'update');
    $router->addRoute('GET', '/category/delete/{id:\d+}',CategoryController::class, 'destroy');
    $router->addRoute('GET', '/product/create', ProductController::class, 'create');
    $router->addRoute('POST', '/product/create', ProductController::class, 'store');
    $router->addRoute('GET', '/product/edit/{id:\d+}/{slug:\w+}', ProductController::class, 'edit');
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