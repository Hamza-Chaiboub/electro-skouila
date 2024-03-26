<?php

class ErrorHandler
{
    public static function categoryErrorHandler()
    {
        session_start();
        $_SESSION["error"] = "An error occurred while creating the new category";
    }
}