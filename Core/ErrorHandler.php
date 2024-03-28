<?php

class ErrorHandler
{

    public static function getError($type ,$message)
    {
        $_SESSION[$type] = $message;
    }
}