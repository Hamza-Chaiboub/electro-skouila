<?php

namespace Controllers;
class AdminController
{
    public function home(): void
    {
        view('admin/dashboard/home.view', [
            'title' => 'Dashboard'
        ]);
    }
}