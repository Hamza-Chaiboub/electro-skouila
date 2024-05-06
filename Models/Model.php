<?php

namespace Models;

use Controllers\HomeController;
use Core\DatabaseConnection;

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
            //view('errors/404');
            HomeController::notFound();
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

    public static function getAllExcept($id): false|array
    {
        new static();
        return static::$database->selectAllExcept(static::$table, $id);
    }

    public static function getAllOrFail(): false|array
    {
        new static();
        $data = static::$database->selectAll(static::$table);

        if($data == null) {
            //view('errors/404');
            HomeController::notFound();
            exit();
        }
        return $data;
    }

    public static function paginate($fields = []): false|array
    {
        new static();
        return static::$database->selectWithPagination(static::$table, $fields);
    }
}