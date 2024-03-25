<?php
require_once __DIR__ . '/../../Controllers/CategoryController.php';
require_once __DIR__ . '/../../Core/Uploader.php';

if(isset($_POST['submit'])){
    if(!empty($_POST["name"])){
        $data["featured"] = $_POST["featured"] ?? 0;
        $data["name"] = $_POST["name"];
        $data["description"] = $_POST["description"];
        $data["image"] = (new ImageUploader($_FILES))->storeImage();

        $newCat = new CategoryController();
        $newCat->store($data);
        header('Location: /');
    }else {
        //$error = "Please type a name for the new category!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}