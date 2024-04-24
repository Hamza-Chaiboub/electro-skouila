<?php
const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . 'Core/functions.php';

$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];

require root_path('Core/MyRouter.php');
$router = new MyRouter();

$routes = require root_path('routes.php');

setSession();

// Testing purposes
//dd(date('Y-m-d', strtotime("+1 week")));
dd(User::findAllNewerThan(date('2024-03-02'), "month"));
$date = date("Y-m-d");
echo date('Y-m-d',strtotime(User::findOrFail(["id" => 13])->created_at)) == $date ? 'true' : 'false';
dd(date('Y-m-d',strtotime(User::findOrFail(["id" => 13])->created_at)));
// End testing

$router->matchRoute($uri, $method);

DatabaseConnection::closeConnection();