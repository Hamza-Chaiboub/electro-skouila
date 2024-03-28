<?php
require_once __DIR__ . '/../../Controllers/CategoryController.php';

//var_dump($_POST);
//die();
$newCat = new CategoryController();
$newCat->store($_POST);