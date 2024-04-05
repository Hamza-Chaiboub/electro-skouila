<?php

function root_path($path): string
{
    return BASE_PATH . $path;
}

function view($path, $attributes = []): void
{

    extract($attributes);

    require root_path('views/' . $path . '.php');
}

function setSession(): void
{
    if(!isset($_SESSION)) { session_start(); }
}

function dd($var)
{
    echo "<pre>";
    echo var_dump($var);
    echo "</pre>";
    die();
}