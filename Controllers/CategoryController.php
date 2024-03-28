<?php

require_once 'DatabaseConnection.php';
require_once __DIR__ . '/../Core/ErrorHandler.php';
require_once __DIR__ . '/../Core/Uploader.php';
class CategoryController
{
    private DatabaseConnection $database;

    public function __construct(){
        $this->database = new DatabaseConnection();
    }

    public function index()
    {
        $query = "SELECT * FROM categories";

        $categories = $this->database->run($query);
        if ($categories->rowCount() < 0) {
            return null;
        }

        require __DIR__ . '/../views/categories/categories.php';
        $this->database->closeConnection();
    }

    public function featured()
    {
        $query = "SELECT * FROM categories WHERE featured = true";

        $categories = $this->database->run($query);
        $this->database->closeConnection();

        if ($categories->rowCount() < 0) {
            return null;
        }

        return $categories;
    }

    public function create(): void
    {
        require __DIR__ . '/../views/categories/create.php';
    }

    public function store($data): void
    {
        $query = "INSERT INTO categories (name, description, image, featured) values (?, ?, ?, ?)";

        if(isset($_POST['submit'])){
            if(!empty($_POST["name"])){
                $data["featured"] = $_POST["featured"] ?? 0;
                $data["name"] = $_POST["name"];
                $data["description"] = $_POST["description"];
                $data["image"] = (new ImageUploader($_FILES))->storeImage();

                header('Location: /');

                $this->database->run($query, [$data["name"], $data["description"], $data["image"], $data["featured"]]);
                exit();
            }else {
                ErrorHandler::getError('name', 'Category name cannot be empty');
                //var_dump($_SESSION["error"]);
                //$error = "Please type a name for the new category!";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }


    }

    public function view($id)
    {
        $query = "SELECT * FROM categories WHERE `id` = :id LIMIT 1";

        $category = $this->database->record($query, ['id' => $id]);

        if (! $category) {
            $category = null;
        }

        require __DIR__ . '/../views/categories/view.php';
    }

    public function edit($id)
    {
        $query = "SELECT * FROM categories where `id` = :id LIMIT 1";

        $category = $this->database->record($query, ['id' => $id]);

        if (! $category) {
            $category = null;
        }

        require __DIR__ . '/../views/categories/edit.php';
    }

    public function update($id, $data): void
    {
        $query = "UPDATE categories
                  SET name = :name, description = :description, image = :image, featured = :featured
                  WHERE `id` = :id";
        $params = [
            "name" => $data["name"],
            "description" => $data["description"],
            "image" => $data["image"],
            "featured" => $data["featured"],
            'id' => $id
        ];
        $this->database->run($query, $params);
    }

    public function destroy($id): void
    {
        $query = "DELETE FROM categories WHERE `id` = :id";
        $args = ['id' => $id];
        $this->database->run($query, $args);
        header('location: /categories');
    }

}