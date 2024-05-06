<?php

namespace Models;

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
        /*new static();

        if ( isset($_POST["update-product"]) ) {
            Validator::validateName($_POST["name"]);
            if(Errors::getAllErrors()) {
                ProductController::edit($id);
            }
            $_POST['featured'] = $_POST["featured"] ?? 0;
            $old_image = $_POST["image"];

            $new_image = new ImageUploader($_FILES,"image");

            $_POST["image"] = $new_image->storeImage() ?? $_POST["image"];

            if (!$new_image->error && file_exists(__DIR__ . '/../public' . $old_image) && !empty($old_image)) {
                unlink(__DIR__ . '/../public' . $old_image);
            }

            static::$database->update(static::$table, $id, static::$fillable);
        }

        header("Location: /category/" . $_POST['id']);
        exit();*/
    }

    public static function slugify($input): string
    {
        $slug = strtolower($input);
        $slug = str_replace(' ', '_', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return trim($slug, '-');
    }
}