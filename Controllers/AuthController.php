<?php

require_once 'DatabaseConnection.php';
class AuthController
{
    private DatabaseConnection $database;

    public function __construct(){
        $this->database = new DatabaseConnection();
    }
    public function view($id): void
    {
        session_start();
        $_SESSION["user"] = $this->database->run('SELECT * FROM users WHERE `id` = :id', ['id' => $id])->fetch();
        $user = $_SESSION["user"];

        view('Auth/index.view', ['user' => $user]);
    }

    public function createUser()
    {
        
    }

    public function storeUser()
    {
        
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

    public function login()
    {
        
    }

    public function logout()
    {
        
    }
}