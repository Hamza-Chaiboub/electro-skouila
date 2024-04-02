<?php

class HomeController
{
    public function home()
    {
        $title = "Home";
        include __DIR__ . '/home.php';
    }
}