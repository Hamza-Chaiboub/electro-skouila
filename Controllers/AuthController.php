<?php

use JetBrains\PhpStorm\NoReturn;

require_once 'DatabaseConnection.php';
require_once __DIR__ . "/../Core/Validator.php";
class AuthController extends Validator
{

    /**
     * @var array|mixed
     */
    public $errors = [];
    private DatabaseConnection $database;

    public function __construct(){
        $this->database = new DatabaseConnection();
    }
    public static function view($id, $username): void
    {
        setSession();

        if($_SESSION["user"]->id == $id && $_SESSION["user"]->username === $username) {
            view('Auth/profile.view', ["id" => $id, "title" => "Profile"]);
            exit();
        }

        view("errors/not-found");
        exit();
    }

    public function createUser()
    {
        
    }

    public function storeUser(): void
    {
        if(isset($_POST["register"])) {
            Validator::validateEmail($_POST["email"]);
            Validator::validatePassword($_POST["password"]);
            Validator::validatePasswordConfirmation($_POST["password"], $_POST["confirm-password"]);
            Validator::validateAcceptTerms($_POST["terms"] ?? null);
        }

        if(!empty(Errors::getAllErrors())) {
            $this->register();
            unset($_SESSION["errors"]);
            exit();
        }

        $fillable = [
            "email",
            "password",
            "profile_picture"
        ];

        $_POST["profile_picture"] = "/storage/img/default-profile-picture-04-04-2024-23-34-05.jpeg";

        self::hashPassword($_POST["password"]);

        $this->database->insert("users", $fillable);

        $user = DatabaseConnection::checkRecordExistence("users", "email", $_POST["email"]);

        $_SESSION["logged_in"] = true;
        $_SESSION["id"] = $user->id;
        $_SESSION["user"] = $user;

        self::login();
    }

    public function editUser()
    {
        
    }

    public function updateUser($id, $username): void
    {
        User::update($id);
        header("Location: /profile/" . $_POST['id'] . "/" . $_POST["username"]);
        exit();
    }

    public function destroyUser()
    {
        
    }

    public function setUserRole()
    {
        
    }

    public static function login($error = ""): void
    {
        if(!Auth::authenticated()){
            view('Auth/login.view', ["error" => $error, "title" => "Login"]);
        }
        else {
            header("Location: /");
        }
    }

    public function register($errors = []): void
    {
        if(!Auth::authenticated()){
            view('Auth/register.view', ["errors" => $errors, "title" => "Register"]);
        }
        else {
            header("Location: /");
        }
    }

    public function authenticate()
    {
        if(isset($_POST["submit"])) {
            $user = $this->database->run('SELECT * FROM users WHERE `email` = :email',
                                        ['email' => $_POST["email"]])
                                        ->fetch();

            if($user) {
                if(password_verify($_POST["password"], $user->password)) {
                    setSession();
                    $_SESSION["logged_in"] = true;
                    $_SESSION["id"] = $user->id;
                    $_SESSION["user"] = Auth::getAll();
                    //return self::view($user->id);
                    header("Location: /profile/{$user->id}/{$user->username}");
                }else {
                    $this->error = "Email or password are invalid!";
                    return self::login($this->error);
                }

            } else {
                $this->error = "Email or password are invalid!";
                return self::login($this->error);
            }
        }

        return self::login($this->error);

    }

    public function logout(): void
    {
       setSession();
       unset($_SESSION["user"]);
       $_SESSION["logged_in"] = false;
       header("Location: /");
    }

    public static function hashPassword($password): string
    {
        $_POST["password"] = password_hash($password, PASSWORD_DEFAULT);
        return $_POST["password"];
    }

}