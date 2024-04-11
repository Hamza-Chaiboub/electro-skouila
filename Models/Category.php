<?php

class Category
{
    protected static DatabaseConnection $database;
    private static string $table;

    private static array $fillable = [
        "name",
    ];

    public function __construct()
    {
        static::$database = new DatabaseConnection();
        static::$table = 'categories';
    }

    public static function findBy($field)
    {
        new static();
        return static::$database->select(static::$table, $field);
    }
}