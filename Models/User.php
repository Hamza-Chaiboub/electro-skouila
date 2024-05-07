<?php

namespace Models;

use Controllers\UserController;
use Core\Auth;
use Core\DatabaseConnection;
use Core\Errors;
use Core\ImageUploader;
use Core\Validator;

class User extends Model
{
    protected static string $table = "users";

    protected static array $fillable = [
        "first_name",
        "last_name",
        "username",
        "role",
        "email",
        "phone_number",
        "address",
        "profile_picture"
    ];

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
            (new UserController())->register();
            unset($_SESSION["errors"]);
            exit();
        }

        $fillable = [
            "email",
            "password",
            "profile_picture",
            "username"
        ];

        $_POST["profile_picture"] = "/storage/img/default-profile-picture.jpeg";

        UserController::hashPassword($_POST["password"]);

        $_POST['username'] = "user" . bin2hex(random_bytes(3));

        DatabaseConnection::insert(static::$table, $fillable);

        $user = DatabaseConnection::checkRecordExistence("users", "email", $_POST["email"]);

        $_SESSION["logged_in"] = true;
        $_SESSION["id"] = $user->id;
        $_SESSION["user"] = $user;

        UserController::login();
    }

    public static function update($id, $username): void
    {
        new static();

        if ( isset($_POST["update-user"]) ) {
            $old_profile_picture = $_POST["profile_picture"];

            $new_image = new ImageUploader($_FILES,"new_profile_picture");

            $_POST["profile_picture"] = $new_image->storeImage() ?? $_POST["profile_picture"];

            $_POST["email"] = Auth::getAllUserData()->email;

            Validator::validateUsername($_POST["username"]);
            //Validator::validateUsername($username);

            if (!empty(Errors::getAllErrors())) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            if (!$new_image->error && isset($old_profile_picture)) {
                unlink(__DIR__ . '/../public' . $old_profile_picture);
            }

            static::$database->update(static::$table, $id, static::$fillable);

            $_SESSION["user"] = Auth::getAllUserData();
        }

        header("Location: /profile/" . $_POST['id'] . "/" . $_POST["username"]);
        exit();
    }

    public static function auth(): void
    {
        new static();
        if(isset($_POST["submit"])) {
            $user = static::findOrFail(["email" => $_POST["email"]]);

            if($user) {
                if(password_verify($_POST["password"], $user->password)) {
                    setSession();
                    $_SESSION["logged_in"] = true;
                    $_SESSION["id"] = $user->id;
                    $_SESSION["user"] = Auth::getAllUserData();
                    //return self::view($user->id);
                    header("Location: /profile/{$user->id}/{$user->username}");
                    exit();
                }
            }
            Errors::set('email', 'Email or password or both are incorrect');
        }

        if(!empty(Errors::getAllErrors())) {
            UserController::login();
            unset($_SESSION["errors"]);
            exit();
        }
    }

    public static function deauth(): void
    {
        new static();
        setSession();
        unset($_SESSION["user"]);
        $_SESSION["logged_in"] = false;
        header("Location: /");
    }
}