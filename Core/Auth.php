<?php

class Auth
{
    private static $allData;

    public static function getAll()
    {
        if(isset($_SESSION["id"])) {

            $user = User::findBy(["id" => $_SESSION["id"]]);

            if(isset($user->password)) $user->password = null;
            if(!isset($user->profile_picture)) $user->profile_picture = "/storage/img/default-profile-picture.jpeg";

            return self::$allData = $user;
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