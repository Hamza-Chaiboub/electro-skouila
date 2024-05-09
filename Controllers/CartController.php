<?php

namespace Controllers;

use Models\Product;

class CartController
{
    public static function addToCart($id): void
    {
        $product = Product::findOrFail([
            "id" => $id,
        ]);

        if(isset($_SESSION['cart'][$product->id])){
            $_SESSION['cart'][$product->id]["quantity"]++;
        } else {
            $_SESSION['cart'][$product->id]["data"] = $product;
            $_SESSION['cart'][$product->id]["quantity"] = 1;
        }
        header("Location:" . $_SERVER['HTTP_REFERER']);
        //dd($_SESSION['cart']);
    }

    public static function increment($id)
    {
        $productQuantity = $_SESSION['cart'][$id]["quantity"];
        if(isset($productQuantity)){
            $productQuantity++;
        }
        $_SESSION['cart'][$id]["quantity"] = $productQuantity;
        print $productQuantity;
    }

    public static function decrement($id)
    {
        $productQuantity = $_SESSION['cart'][$id]["quantity"];
        if(isset($productQuantity) && $productQuantity > 1){
            $productQuantity--;
        }
        $_SESSION['cart'][$id]["quantity"] = $productQuantity;
        print $productQuantity;
    }
}