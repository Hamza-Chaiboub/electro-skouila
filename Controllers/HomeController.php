<?php

class HomeController
{
    public function home()
    {
        $title = "Home";
        view("home", ["title" => $title]);
    }

    public static function notFound(): void
    {
        $title = "404";
        view("errors/404", [
            "title" => $title
        ]);
    }
}