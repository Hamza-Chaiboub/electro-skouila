<?php

namespace Core;
class Errors
{

    private static array $errors = [];

    public static function set(string $field, string $message): void
    {
        setSession();
        self::$errors[$field] = $message;
        $_SESSION["errors"][$field] = self::$errors[$field];
    }

    public static function getAllErrors(): array
    {
        return self::$errors;
    }
    public static function get($field)
    {
        setSession();
        //self::$errors = $_SESSION["errors"] ?? [];

        if(isset($_SESSION["errors"])) {
            if(!key_exists($field, $_SESSION["errors"])) {
                return null;
            }else {
                return $_SESSION["errors"][$field];
            }
        }

        return null;
    }

}