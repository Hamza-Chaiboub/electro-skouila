<?php

use JetBrains\PhpStorm\NoReturn;

class ProductController
{
    public function show($id, $slug): void
    {
        $product = Product::findOrFail(["id" => $id]);
        view('product/show.view', [
            "page" => "products",
            "product" => $product,
            "title" => $product->name,
            "category_id" => $product->category_id,
        ]);
    }

    public static function index(): void
    {
        $products = Product::getAll();

        view('product/index.view', [
            "page" => "products",
            "title" => "All products",
            "products" => $products
        ]);
    }

    public static function create(): void
    {
        view('product/create.view', [
            "page" => "products",
            "title" => "Create New Product",
        ]);
    }

    public function store(): void
    {
        Product::save();
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