<?php
require_once __DIR__ . '/../../Controllers/CategoryController.php';

if(isset($_POST['submit'])){
    $id = $_POST["id"];
    $data["name"] = $_POST["name"];
    $data["description"] = $_POST["description"];
    $data["image"] = $_POST["image"];
    $data["featured"] = $_POST["featured"] ?? 0;

    

    $newCat = new CategoryController();
    $newCat->update($id, $data);
    header('Location: /');
}