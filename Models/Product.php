<?php

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