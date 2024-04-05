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
    public static function view($id)
    {
        setSession();
        $_SESSION["logged_in"] ? view('Auth/profile.view', ["id" => $id, "title" => "Profile"]) : header("Location: /");
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

    public function updateUser(): void
    {
        //dd($_POST);
        $query = "UPDATE users
                  SET first_name = :first_name, last_name = :last_name, role = :role, phone_number = :phone_number, address = :address, username = :username, profile_picture = :profile_picture
                  WHERE `id` = :id";
        if(isset($_POST['update-user'])) {
            if (!empty($_POST["username"])) {

                $params = [
                    "first_name" => $_POST["first_name"],
                    "last_name" => $_POST["last_name"],
                    "role" => $_POST["role"],
                    "phone_number" => $_POST["phone_number"],
                    "address" => $_POST["address"],
                    "username" => $_POST["username"],
                    "profile_picture" => (new ImageUploader($_FILES,"profile_picture"))->storeImage() ?? $_POST["old_profile_picture"],
                    'id' => $_POST["id"]
                ];

                Validator::validateUsername($_POST["username"]);

                if(!empty(Errors::getAllErrors())) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }

                $this->database->run($query, $params);

                $_SESSION["user"] = Auth::getAll();

                header("Location: /profile/" . $_POST['id'] . "/" . $_POST["username"]);

            }
            else {
                //ErrorHandler::getError('name', 'Category name cannot be empty');
                //var_dump($_SESSION["error"]);
                //$error = "Please type a name for the new category!";
                //header('Location: ' . $_SERVER['HTTP_REFERER']);
                die('something went wrong');
            }
            exit();
        }
    }

    public function destroyUser()
    {
        
    }

    public function setUserRole()
    {
        
    }

    public static function login($error = "")
    {
        if(!Auth::authenticated()){
            view('Auth/login.view', ["error" => $error, "title" => "Login"]);
        }
        else {
            header("Location: /");
        }
    }

    public function register($errors = [])
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

    public function logout()
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