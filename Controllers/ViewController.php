<?php

class ViewController
{
    public function view($file)
    {
        include_once (__DIR__ . '/../views/categories/'.$file);
    }
}