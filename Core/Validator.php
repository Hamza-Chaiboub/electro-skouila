<?php

class Validator
{
    private $errors = [];
    public static function validate($data)
    {
        $arr = [
            'name' => 'required',
            'description' => 'required'
        ];

        for($i = 0; $i < count($arr); $i++) {

        }
    }
}