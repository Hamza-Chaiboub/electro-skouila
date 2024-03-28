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

function storagePath($path): string
{
    return root_path('storage/' . $path);
}