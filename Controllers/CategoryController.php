<?php

require_once __DIR__ . '/../Core/ErrorHandler.php';
require_once __DIR__ . '/../Core/Uploader.php';
class CategoryController
{
    private DatabaseConnection $database;

    public function __construct(){
        $this->database = new DatabaseConnection();
    }

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

    public function view($id): void
    {
        $category = Category::findOrFail(["id" => $id]);

        if (! $category) {
            $category = null;
        }

        view('categories/view', [
            'category' => $category,
            'page' => 'categories',
            'title' => $category->name
        ]);
    }

    public function edit($id): void
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

        if(file_exists(__DIR__ . '/../public' . $category->image)) {
            unlink(__DIR__ . '/../public' . $category->image);
        }

        Category::destroy($id);

        header('location: /categories');
    }

}