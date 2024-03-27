<?php

class ErrorHandler
{

    public static function getError($type ,$message)
    {
        session_start();
        $_SESSION[$type] = $message;
    }
}