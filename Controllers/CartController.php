<?php

namespace Controllers;

use Models\Product;

class CartController
{
    public static function addToCart($id)
    {
        $product = Product::findOrFail([
            "id" => $id,
        ]);
        $_SESSION['cart'][$product->id] = $product;

        /*if(isset($_SESSION['cart'][$product->id])){
            $_SESSION['cart'][$product->id]["count"] += 1;
        }*/
        header("Location:" . $_SERVER['HTTP_REFERER']);
        //dd($_SESSION['cart']);
    }
}