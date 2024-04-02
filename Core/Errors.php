<?php

class Errors
{

    private static array $errors;
    public static function get($field)
    {
        setSession();
        self::$errors = $_SESSION["errors"] ?? [];

        if(!key_exists($field, self::$errors)) {
            return;
        }else {
           return self::$errors[$field];
        }
    }

}