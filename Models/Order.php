<?php

class Order extends Model
{
    protected static string $table = "orders";

    protected static array $fillable = [
        "user_id",
        "subtotal",
        "discount",
        "shipping",
        "tax",
        "total",
        "currency",
        "status"
    ];
}