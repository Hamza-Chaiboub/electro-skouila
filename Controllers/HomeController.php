<?php

class HomeController
{
    public function home()
    {
        $title = "Home";
        include __DIR__ . '/home.php';
    }

    public function notFound(): void
    {
        $title = "404";
        view("errors/not-found");
    }
}