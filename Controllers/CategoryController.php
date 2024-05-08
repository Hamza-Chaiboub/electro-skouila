<?php

namespace Controllers;
use Models\Category;

class CategoryController
{
    public static function index(): void
    {
        $categories = Category::getAll();

        if (!$categories) {
            $categories = null;
        }

        view('categories/categories', [
            'categories' => $categories,
            'page' => 'categories',
            'title' => 'All Categories'
        ]);
    }

    public function featured(): ?array
    {
        $categories = Category::findAllBy(['featured' => true]);

        if (!$categories) {
            return null;
        }

        return $categories;
    }

    public static function create(): void
    {
        view('categories/create', [
            "page" => "categories",
            "title" => "Create Category"
        ]);
    }

    public function store(): void
    {
        Category::save();
    }

    public function view($id, $slug): void
    {
        $category = Category::findOrFail([
            "id" => $id,
            "slug" => $slug
        ]);

        view('categories/view', [
            'category' => $category,
            'page' => 'categories',
            'title' => $category->name
        ]);
    }

    public static function edit($id): void
    {
        $category = Category::findOrFail(["id" => $id]);

        view('categories/edit', ['category' => $category, 'page' => 'categories', 'title' => $category->name]);
    }

    public function update($id): void
    {
        Category::update($id);
    }

    public function destroy($id): void
    {
        //get image path
        $category = Category::findOrFail(['id' => $id]);

        if(file_exists(__DIR__ . '/../public' . $category->image) && !empty($category->image)) {
            unlink(__DIR__ . '/../public' . $category->image);
        }

        Category::destroy($id);

        header('location: /categories');
    }

}