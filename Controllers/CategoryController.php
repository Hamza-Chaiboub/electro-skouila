<?php

require_once 'DatabaseConnection.php';
class CategoryController
{
    private DatabaseConnection $database;

    public function __construct(){
        $this->database = new DatabaseConnection();
    }

    public function index(): false|PDOStatement|null
    {
        /*$query = "SELECT * FROM categories";
        $categories = $this->db->query($query);
        if($categories->rowCount() > 0){
            return $categories->fetchAll();
        }
        else
        {
            return null;
        }*/
        $categories = $this->database->run("SELECT * FROM categories");
        if ($categories->rowCount() < 0) {
            return null;
        }

        return $categories;

    }
    public function create($data): void
    {
        $query = "INSERT INTO categories (name, description, image) values (?, ?, ?)";
        /*$params = [
            $data["name"],
            $data["description"],
            $data["image_path"]
        ];
        $this->db->prepare($query)->execute($params);*/

        $this->database->run($query, [$data["name"], $data["description"], $data["image"]]);
    }

    public function view($id)
    {
        /*$query = "SELECT *
                  FROM categories
                  WHERE `id` = $id
                  LIMIT 1";*/
        //return $this->db->query($query)->fetchObject();

        return $this->database->record("SELECT * FROM categories WHERE `id` = :id LIMIT 1", ['id' => $id]);
    }

    public function edit($id)
    {
        /*$query = "SELECT *
                  FROM categories
                  WHERE `id` = :id
                  LIMIT 1";
        $params = [
            'id' => $id
        ];
        $statement = $this->database->prepare($query);
        $statement->execute($params);
        return $statement->fetchObject();*/

        return $this->database->record("SELECT * FROM categories where `id` = :id LIMIT 1", ['id' => $id]);
    }

    public function update($id, $data): void
    {
        $query = "UPDATE categories
                    SET name = :name, description = :description, image = :image
                    WHERE `id` = :id";
        $params = [
            "name" => $data["name"],
            "description" => $data["description"],
            "image" => $data["image"],
            'id' => $id
        ];
        $this->database->run($query, $params);
    }

    public function destroy($id): void
    {
        $query = "DELETE FROM categories WHERE `id` = :id";
        $args = ['id' => $id];
        $this->database->run($query, $args);
    }

}