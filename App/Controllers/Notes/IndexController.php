<?php

namespace App\Controllers\Notes;

class IndexController
{
    public function __invoke()
    {
        if (!auth())
        {
            return redirect('/login');
        }
        view('notes', [
            'user' => auth()
        ]);
    }
}