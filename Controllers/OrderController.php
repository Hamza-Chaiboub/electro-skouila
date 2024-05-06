<?php

namespace Controllers;
use Models\Order;

class OrderController
{
    public static function index() {

    }

    public static function getOrders($user_id): false|array
    {
        dd(Order::findAllBy([
            "user_id" => $user_id
        ]));
    }

    public static function getLastOrder()
    {
        
    }
}