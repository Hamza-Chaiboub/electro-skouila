<?php

class Category extends Model
{
    protected static string $table = 'categories';
    protected static array $fillable = [
        "name",
        "description",
        "image",
        "featured"
    ];
    public static function save(): void
    {
        new static();
        if(isset($_POST["submit"])) {
            Validator::validateCategoryName($_POST["name"]);
        }

        if(!empty(Errors::getAllErrors())) {
            CategoryController::create();
            unset($_SESSION["errors"]);
            exit();
        }

        $_POST["image"] = (new ImageUploader($_FILES, "image"))->storeImage();

        $_POST["featured"] = $_POST["featured"] ?? 0;

        DatabaseConnection::insert(static::$table, static::$fillable);

        CategoryController::index();
    }

    public static function update($id): void
    {
        new static();

        if ( isset($_POST["update-category"]) ) {
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
        exit();
    }

    public static function destroy($id): void
    {
        new static();
        static::$database->destroy(static::$table, $id);
    }
}