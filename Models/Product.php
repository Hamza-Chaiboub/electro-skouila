<?php

namespace Models;

use Controllers\ProductController;
use Core\DatabaseConnection;
use Core\Errors;
use Core\ImageUploader;
use Core\Validator;

class Product extends Model
{
    protected static string $table = "products";

    protected static array $fillable = [
        "name",
        "price",
        "description",
        "quantity",
        "category_id",
        "featured_image",
        "slug"
    ];

    public static function save(): void
    {
        new static();
        if(isset($_POST["name"])) {
            Validator::validateName($_POST["name"]);
        }

        if(!empty(Errors::getAllErrors())) {
            ProductController::create();
            unset($_SESSION["errors"]);
            exit();
        }

        $_POST["slug"] = self::slugify($_POST["name"]);

        $_POST["featured_image"] = (new ImageUploader($_FILES, "featured_image"))->storeImage() ?? '';

        //dd($_POST["featured_image"]);

        DatabaseConnection::insert(static::$table, static::$fillable);

        ProductController::index();
    }

    public static function update($id)
    {
        new static();

        if ( isset($_POST["update-product"]) ) {
            Validator::validateName($_POST["name"]);
            if(Errors::getAllErrors()) {
                ProductController::edit($id, $slug = "");
            }
            $_POST['featured'] = $_POST["featured"] ?? 0;
            $old_image = $_POST["featured_image"];

            $new_image = new ImageUploader($_FILES,"featured_image");

            $_POST["featured_image"] = $new_image->storeImage() ?? $_POST["featured_image"];

            //dd($old_image);

            if (!$new_image->error && file_exists(__DIR__ . '/../public' . $old_image) && !empty($old_image)) {
                unlink(__DIR__ . '/../public' . $old_image);
            }

            static::$database->update(static::$table, $id, static::$fillable);
        }

        //header("Location: /category/" . $_POST['id']);
        exit();
    }
}