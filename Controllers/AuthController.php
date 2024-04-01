<?php

use JetBrains\PhpStorm\NoReturn;

require_once 'DatabaseConnection.php';
class AuthController
{

    public $error;
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
        self::register();
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

    public static function register($error = "")
    {
        if(!$_SESSION["logged_in"]){
            view('Auth/register.view', ["error" => $error, "title" => "Register"]);
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
}