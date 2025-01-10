<?php

namespace App\Controllers;

class IndexController
{
    public function __invoke()
    {
        // $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : null;
        if (auth()) {
            view('dashboard', [
                'user' => auth()
            ]);
        } else {
            view('index', template: 'guest');
        }   
    }

}