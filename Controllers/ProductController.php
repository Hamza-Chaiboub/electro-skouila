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
            "title" => $product->name
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

    public static function edit($id, $slug): void
    {
        $product = Product::findOrFail(["id" => $id]);

        view('product/edit.view', [
            "page" => "products",
            "product" => $product,
            "title" => $product->name
        ]);
    }

    public function store(): void
    {
        Product::save();
    }

    public function update($id): void
    {
        Product::update($id);
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