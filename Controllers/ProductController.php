<?php

use JetBrains\PhpStorm\NoReturn;

class ProductController
{
    public function show($id, $slug): void
    {
        $product = Product::findBy(["id" => $id]);
        view('product/show.view', [
            "page" => "products",
            "product" => $product,
            "title" => $product->name,
        ]);
    }

    public function index(): void
    {
        $products = Product::getAll();

        view('product/index.view', [
            "page" => "products",
            "title" => "All products",
            "products" => $products
        ]);
    }

    public function showProductsFromCategory($id): void
    {
        $products = Product::findAllBy(["category_id" => $id]);
        view('product/index.view', [
            "page" => "products",
            "title" => "All products",
            "products" => $products
        ]);
    }
}