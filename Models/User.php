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

    public static function save()
    {
        new static();
        if(isset($_POST["register"])) {
            Validator::validateEmail($_POST["email"]);
            Validator::validatePassword($_POST["password"]);
            Validator::validatePasswordConfirmation($_POST["password"], $_POST["confirm-password"]);
            Validator::validateAcceptTerms($_POST["terms"] ?? null);
        }

        if(!empty(Errors::getAllErrors())) {
            (new AuthController())->register();
            unset($_SESSION["errors"]);
            exit();
        }

        $fillable = [
            "email",
            "password",
            "profile_picture"
        ];

        $_POST["profile_picture"] = "/storage/img/default-profile-picture-04-04-2024-23-34-05.jpeg";

        AuthController::hashPassword($_POST["password"]);

        DatabaseConnection::insert(static::$table, $fillable);

        $user = DatabaseConnection::checkRecordExistence("users", "email", $_POST["email"]);

        $_SESSION["logged_in"] = true;
        $_SESSION["id"] = $user->id;
        $_SESSION["user"] = $user;

        self::login();
    }

    public static function update($id)
    {
        new static();

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