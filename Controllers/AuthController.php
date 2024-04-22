<?php

class AuthController
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

}