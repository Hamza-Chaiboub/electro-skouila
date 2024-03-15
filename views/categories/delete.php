<?php

require_once __DIR__ . '/../../Controllers/CategoryController.php';

if (isset($_GET["id"])) {
    $toBeDeleted = new CategoryController();
    $toBeDeleted->destroy($_GET["id"]);
    header("location: /");
    die();
}