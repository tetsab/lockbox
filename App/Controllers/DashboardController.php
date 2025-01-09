<?php

namespace App\Controllers;

class DashboardController
{
    public function __invoke()
    {
        if (!auth())
        {
            return redirect('/login');
        }
        echo "Logged in ".auth()->name;
    }
}