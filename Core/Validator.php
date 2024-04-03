<?php

class Validator
{
    public static function validateEmail($input): void
    {
        if (isset($input)  && empty($input)) {

            Errors::set("email", "Email required");

        } else if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {

            Errors::set("email", "Invalid Email");

            self::old(self::getKeyFromArray($_POST, $input));

        }
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
        if($_SESSION["errors"]["password"] === null && $password !== $PasswordConfirmation) {

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

    public static function old($key)
    {
        return $_POST[$key] ?? null;
    }

    public static function getKeyFromArray($arr, $val)
    {
        return array_search($val, $arr);
    }
}