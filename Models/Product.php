<?php

class Product
{
    protected static DatabaseConnection $database;
    private static string $table;

    private static array $fillable = [
        "name",
        "price",
        "slug"
    ];

    public function __construct()
    {
        static::$database = new DatabaseConnection();
        static::$table = 'products';
    }

    public static function findBy($field)
    {
        new static();
        return static::$database->select(static::$table, $field);
    }

    public static function getAll()
    {
        new static();
        return static::$database->select(static::$table);
    }
}