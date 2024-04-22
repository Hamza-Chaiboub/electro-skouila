<?php

class Card
{
    private static ?Card $_instance = null;
    private static array $data;
    private static $model;

    public static function getInstance (): Card
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    public static function make($model): Card
    {
        self::getInstance();
        self::$model = $model;
        return self::$_instance;
    }

    public static function title($title): Card
    {
        self::$data['cardTitle'] = $title;
        return self::$_instance;
    }

    public static function count(): Card
    {
        self::$data['cardCount'] = count(self::$model::getAll());
        return self::$_instance;
    }

    public static function icon($icon): Card
    {
        self::$data['cardIcon'] = $icon;
        return self::$_instance;
    }

    public static function iconColor($value): Card
    {
        self::$data['iconColor'] = "bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-$value-600 to-$value-400 text-white shadow-$value-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center";
        return self::$_instance;
    }

    public static function period($value): Card
    {
        self::$data['cardPeriod'] = $value;
        return self::$_instance;
    }

    public static function draw(): void
    {
        view('admin/dashboard/partials/card', self::$data);
    }
}