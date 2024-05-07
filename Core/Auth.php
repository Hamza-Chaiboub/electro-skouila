<?php

namespace Core;
use Models\User;

class Auth
{
    private static $allData;

    public static function getAllUserData()
    {
        if(isset($_SESSION["id"])) {

            $user = User::findOrFail(["id" => $_SESSION["id"]]);

            if(isset($user->password)) $user->password = null;
            if(!isset($user->profile_picture)) $user->profile_picture = "/storage/img/default-profile-picture.jpeg";

            return self::$allData = $user;
        }
        return false;
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

    public static function isAdmin(): bool
    {
        setSession();
        return isset($_SESSION["logged_in"]) && $_SESSION["user"]->role === "admin";
    }
}