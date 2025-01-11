<?php

namespace App\Controllers;

class IndexController
{
    public function __invoke()
    {
        // $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : null;
        if (!auth()) {
            redirect('/login');  
        }

        return view('notes', [
            'user' => auth()
        ]);
    }

}