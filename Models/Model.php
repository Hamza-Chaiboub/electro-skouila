<?php

class Model
{
    protected static DatabaseConnection $database;
    protected static string $table = "";

    protected static array $fillable = [];

    public function __construct()
    {
        static::$database = new DatabaseConnection();
    }
    public static function findOrFail($field)
    {
        new static();
        $data = static::$database->select(static::$table, $field);

        if($data == null) {
            view('errors/404');
            exit();
        }
        return $data;
    }

    public static function findAllBy($field): false|array
    {
        new static();
        return static::$database->selectAll(static::$table, $field);
    }

    public static function findAllNewerBy($count, $by, $date = ""): false|array
    {
        new static();
        return static::$database->selectAllNewerBy(static::$table, $count, $by, $date);
    }

    public static function getAll(): false|array
    {
        new static();
        return static::$database->selectAll(static::$table);
    }
}