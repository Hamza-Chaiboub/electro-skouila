<?php

class Card
{
    private static array $data;
    private static string $model;

    public static function make($model): Card
    {
        self::$model = $model;
        return new static();
    }

    public static function title($title): Card
    {
        self::$data['cardTitle'] = $title;
        return new static();
    }

    public static function count($count, $by): Card
    {
        self::$data['cardCount'] = count(self::$model::findAllNewerBy($count, $by));
        self::$data['lastCount'] = count(self::$model::findAllNewerBy($count, $by, date('Y-m-d', strtotime("-$count $by")))) - self::$data['cardCount'];
        self::$data['cardPeriod'] = $count == 1 ? $by : $count." ".$by."s";
        self::percentage();
        return new static();
    }

    public static function percentage(): void
    {
        $current = self::$data['cardCount'];
        $previous = self::$data['lastCount'];
        $percentage = $previous == 0 ? ($current - $previous) * 100 : ($current - $previous) / $previous * 100;

        self::$data['cardPercentage'] = strpos($percentage, '.') ? number_format($percentage, 2) : $percentage;
        self::$data['percentageSign'] = $percentage > 0 ? '+' : "";
    }

    public static function icon($icon): Card
    {
        self::$data['cardIcon'] = $icon;
        return new static();
    }

    public static function iconColor($value): Card
    {
        self::$data['iconColor'] = $value;
        return new static();
    }

    public static function draw(): void
    {
        view('admin/dashboard/partials/card', self::$data);
        self::$data = [];
    }
}