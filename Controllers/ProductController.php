<?php

class ProductController
{
    public function show($id, $slug)
    {
        $product = Product::findBy(["id" => $id]);
        view('product/show.view', [
            "page" => "products",
            "product" => $product,
            "title" => $product->name,
        ]);
    }

    public function index()
    {
        $allProducts = Product::getAll();

        view('product/index.view', [
            "page" => "products",
            "title" => "All products",
            "products" => $allProducts
        ]);
    }
}