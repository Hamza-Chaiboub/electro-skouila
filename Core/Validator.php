<?php

namespace Core;

class Validator
{
    public static function validateEmail($input): void
    {
        if (isset($input) && empty($input)) {

            Errors::set("email", "Email required");

        } else if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {

            Errors::set("email", "Invalid Email");

        } else if (DatabaseConnection::checkRecordExistence("users", "email", $input)) {
            Errors::set("email", "Email already taken");
        }

        self::old(self::getKeyFromArray($_POST, $input));
    }

    public static function validateUsername($input): void
    {
        if (isset($input) && empty($input)) {

            Errors::set("username", "Username required");

        } else if (!preg_match('/^(?=.*[a-zA-Z0-9])\S{6,10}$/', $input)) {

            Errors::set("username", "Only letters and numbers are allowed [min: 6 chars, max: 10 chars]");

        } else if (DatabaseConnection::checkRecordExistence("users", "username", $input) && $input !== $_SESSION["user"]->username) {
            Errors::set("username", "Username already taken");
        }

        self::old(self::getKeyFromArray($_POST, $input));
    }

    public static function validatePassword($input): void
    {
        if (isset($input) && empty($input)) {

            Errors::set("password", "Password required");

        } else if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/', $input)) {

            Errors::set("password", "Password must be alphanumerical of 8 characters or more!");

        }

    }

    public static function validatePasswordConfirmation($password, $PasswordConfirmation): void
    {
        if(!isset($_SESSION["errors"]["password"]) && $password !== $PasswordConfirmation) {

            Errors::set("confirm-password", "Passwords don't match!");
            Errors::set("password", "Passwords don't match!");

        }
    }

    public static function validateAcceptTerms($input): void
    {
        if(!isset($input) && $input !== "on"){
            Errors::set("terms", "Please accept 'Terms and Conditions'");
        }
    }

    public static function validateName($input): void
    {
        if (isset($input) && empty($input)) {

            Errors::set("name", "Name cannot be empty");

        }
    }

    public static function old($key)
    {
        return $_POST[$key] ?? null;
    }

    public static function getKeyFromArray($arr, $val): false|int|string
    {
        return array_search($val, $arr);
    }
}