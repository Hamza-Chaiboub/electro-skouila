<?php

namespace Controllers;
use Core\Auth;
use Core\Errors;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\User;

class UserController
{
    public static function view($id, $username): void
    {
        setSession();

        if($_SESSION["user"]->id == $id && $_SESSION["user"]->username === $username) {
            view('Auth/profile.view', ["id" => $id, "title" => "Profile"]);
            exit();
        }

        view("errors/404");
        exit();
    }

    public function storeUser(): void
    {
        User::save();
    }

    public function updateUser($id, $username): void
    {
        User::update($id, $username);
    }

    public static function login(): void
    {
        if(!Auth::authenticated()){
            view('Auth/login.view', ["title" => "Login"]);
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

    public function authenticate(): void
    {
        User::auth();
    }

    public function logout(): void
    {
       User::deauth();
    }

    public static function hashPassword($password): string
    {
        $_POST["password"] = password_hash($password, PASSWORD_DEFAULT);
        return $_POST["password"];
    }

    public static function authApi()
    {
        view('fetch');
    }

    public function fetchAuth()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if(isset($_POST['email'])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
        } else {
            $email = $data["email"];
            $password = $data["password"];
        }


        //$user = User::findOrFail(["email" => $email]);
        $user = User::find(["email" => $email]);

        if($user)
        {
            if(password_verify($password, $user->password)) {
                //setSession();
                //$_SESSION["logged_in"] = true;
                //$_SESSION["id"] = $user->id;
                //$_SESSION["user"] = Auth::getAllUserData();
                //return self::view($user->id);

                $secret_key = 'Hamza';
                $payload = [
                    'iss' => "skouila",
                    'iat' => time(),
                    'exp' => time() + 3600,
                    'sub' => $user->id,
                ];

                $jwt = JWT::encode($payload, $secret_key, 'HS256');

                //print_r(['token' => $jwt]);
                echo json_encode($jwt);

                //echo json_encode(Auth::getAllUserData());
                exit();
            }
        }
        http_response_code(401);
        echo json_encode(['message' => 'Invalid credentials']);
    }

    public static function fetchData()
    {
        $headers = getallheaders();
        $authHeader = $headers["Authorization"];

        if($authHeader)
        {
           $jwt = explode(' ',$authHeader);

            //$decoded = JWT::decode($jwt[1], new Key("Hamza", "HS256"));

            //print_r($decoded);

            //exit();


            try {
                $decoded = JWT::decode($jwt[1], new Key('Hamza', "HS256"));
                $data = User::findOrFail(["id" => $decoded->sub]);

                $data->password = null;

                echo json_encode($data);
            } catch(Exception $e) {
                http_response_code(401);
                echo json_encode(['message' => 'Invalid credentials' . $e->getMessage()]);
            }
        }
    }
}