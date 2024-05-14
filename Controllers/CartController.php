<?php

namespace Controllers;

use Models\Product;

class CartController
{

    public static function index() {
        view('cart/main.view');
    }
    public static function addToCart($id): void
    {
        $product = Product::findOrFail([
            "id" => $id,
        ]);

        if(isset($_SESSION['cart']['products'][$product->id])){
            $_SESSION['cart']['products'][$product->id]["quantity"]++;
        } else {
            $_SESSION['cart']['products'][$product->id]["data"] = $product;
            $_SESSION['cart']['products'][$product->id]["quantity"] = 1;
        }
        static::calculateTotal();
        header("Location:" . $_SERVER['HTTP_REFERER']);
        //dd($_SESSION['cart']);
    }

    public static function increment($id): void
    {
        $productQuantity = $_SESSION['cart']['products'][$id]["quantity"];
        if(isset($productQuantity)){
            $productQuantity++;
        }
        $_SESSION['cart']['products'][$id]["quantity"] = $productQuantity;
        print $productQuantity;
    }

    public static function decrement($id): void
    {
        $productQuantity = $_SESSION['cart']['products'][$id]["quantity"];
        if(isset($productQuantity) && $productQuantity > 1){
            $productQuantity--;
        }
        $_SESSION['cart']['products'][$id]["quantity"] = $productQuantity;
        print $productQuantity;
    }

    public static function removeFromCart($id): void
    {
        //dd($_SESSION['cart']);
        if(count($_SESSION['cart']['products']) == 1){
            unset($_SESSION['cart']);
            print 'hidden';
        }else {
            unset($_SESSION['cart']['products'][$id]);
        }
    }

    public static function calculateTotal(): float|int
    {
        $_SESSION['cart']['total'] = $total = 0;
        if(!isset($_SESSION['cart']['products'])){
            return $total;
        }

        foreach($_SESSION['cart']['products'] as $product){
            $total += $product['data']->price * $product['quantity'];
        }
        $_SESSION['cart']['total'] = $total;
        //dd($_SESSION);
        return $total;
    }
    public static function getTotal()
    {
        //dd($_SESSION['cart']);
        print number_format(static::calculateTotal(), 2);
    }
}