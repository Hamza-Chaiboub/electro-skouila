<?php

use JetBrains\PhpStorm\NoReturn;

require_once 'DatabaseConnection.php';
class AuthController
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

    public function storeUser()
    {
        //echo 'User registered';
        //self::register();

        if(isset($_POST["register"])) {
            if(empty($_POST["email"])) {$this->setErrors("email", "Email required");}
            if(empty($_POST["password"])) {$this->setErrors("password", "Password required");}
            if($_POST["password"] !== $_POST["confirm-password"]) {$this->setErrors("confirm-password", "The two passwords don't match");}
        }

        if(!empty($this->errors)) {
            $this->register($this->errors);
            unset($_SESSION["errors"]);
            exit();
        }

        self::login();

    }

    public function editUser()
    {
        
    }

    public function updateUser()
    {
        
    }

    public function destroyUser()
    {
        
    }

    public function setUserRole()
    {
        
    }

    public static function login($error = "")
    {
        if(!$_SESSION["logged_in"]){
            view('Auth/login.view', ["error" => $error, "title" => "Login"]);
        }
        else {
            header("Location: /");
        }
    }

    public function register($errors = [])
    {
        if(!$_SESSION["logged_in"]){
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
                if($user->password === $_POST["password"]) {
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

    public static function verifyPassword($password)
    {

    }

    private function setErrors(string $field, string $message)
    {
        setSession();
        $this->errors[$field] = $message;
        $_SESSION["errors"] = $this->errors;
    }
}