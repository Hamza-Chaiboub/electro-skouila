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
        return static::$database->select(static::$table, $field) ?? null;
    }

    public static function findAllBy($field): false|array
    {
        new static();
        return static::$database->selectAll(static::$table, $field);
    }

    public static function getAll(): false|array
    {
        new static();
        return static::$database->selectAll(static::$table);
    }
}