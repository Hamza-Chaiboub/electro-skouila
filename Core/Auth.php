<?php

class Auth
{
    public static function query($columns = ['*'])
    {
        if(isset($_SESSION["id"])) {

            $columnsAsString = implode(",", $columns);

            $db = new DatabaseConnection();
            $sql = "SELECT $columnsAsString FROM users WHERE `id` = :id";

            $data = $db::record($sql, ['id' => $_SESSION["id"]]);

            if(isset($data->password)) $data->password = null;

            if(count($columns) == 1 && $columnsAsString !== "*") return $data->$columnsAsString;

            return $data;
        }
    }
}