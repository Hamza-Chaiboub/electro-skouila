<?php

class User
{

    protected static DatabaseConnection $database;
    private static string $table;

    private static array $fillable = [
        "first_name",
        "last_name",
        "username",
        "role",
        "email",
        "phone_number",
        "address",
        "profile_picture"
    ];
    public function __construct()
    {
        static::$database = new DatabaseConnection();
        static::$table = 'users';
    }

    public static function findById($id)
    {
        new User();
        return static::$database->select(static::$table, $id);
    }

    public static function update($id)
    {
        new User();

        if ( isset($_POST["update-user"]) ) {
            $_POST["profile_picture"] = (new ImageUploader($_FILES,"new_profile_picture"))->storeImage() ?? $_POST["profile_picture"];

            $_POST["email"] = Auth::getAll()->email;

            Validator::validateUsername($_POST["username"]);

            if(!empty(Errors::getAllErrors())) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            static::$database->update(static::$table, $id, static::$fillable);

            $_SESSION["user"] = Auth::getAll();
        }
    }
}