<?php

class Model
{
    protected static DatabaseConnection $database;
    private static string $table;

    private static array $fillable = [];
    public function __construct()
    {
        static::$database = new DatabaseConnection();
    }
    public static function save(): void
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

        $_POST["profile_picture"] = "/storage/img/default-profile-picture.jpeg";

        AuthController::hashPassword($_POST["password"]);

        DatabaseConnection::insert(static::$table, $fillable);

        $user = DatabaseConnection::checkRecordExistence("users", "email", $_POST["email"]);

        $_SESSION["logged_in"] = true;
        $_SESSION["id"] = $user->id;
        $_SESSION["user"] = $user;

        AuthController::login();
    }
}