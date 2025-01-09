<?php

namespace App\Controllers;

class IndexController
{
    public function __invoke()
    {
        // $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : null;

        view('index');
    }

}