<?php

class Product extends Model
{
    protected static DatabaseConnection $database;
    protected static string $table = "products";

    protected static array $fillable = [
        "name",
        "price",
        "slug"
    ];
}