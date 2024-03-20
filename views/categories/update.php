<?php
require_once __DIR__ . '/../../Controllers/CategoryController.php';
require_once __DIR__ . '/../../Core/Uploader.php';

if(isset($_POST['submit'])){
    $id = $_POST["id"];
    $data["name"] = $_POST["name"];
    $data["description"] = $_POST["description"];
    $data["featured"] = $_POST["featured"] ?? 0;
    $data["image"] = (new ImageUploader($_FILES))->storeImage() ?? $_POST["image"];

    //var_dump($data["image"]);
    //die();



    $newCat = new CategoryController();
    $newCat->update($id, $data);
    header('Location: /');
}