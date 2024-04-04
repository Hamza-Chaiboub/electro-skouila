<?php

class Auth
{
    private static $allData;

    public static function getAll()
    {
        if(isset($_SESSION["id"])) {

            $db = new DatabaseConnection();
            $sql = "SELECT * FROM users WHERE `id` = :id";

            $data = $db::record($sql, ['id' => $_SESSION["id"]]);

            if(isset($data->password)) $data->password = null;

            return self::$allData = $data;
        }
    }
    public static function query($field = "")
    {

        if($field == "" ) return $_SESSION["user"];

        return $_SESSION["user"]->$field;

    }

    public static function authenticated(): bool
    {
        setSession();
        return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"];
    }

    public static function isAdmin()
    {
        setSession();
        return isset($_SESSION["logged_in"]) && $_SESSION["user"]->role === "admin";
    }
}