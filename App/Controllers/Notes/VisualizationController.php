<?php

namespace App\Controllers\Notes;

class VisualizationController
{
    public function show()
    {
        session()->set('show', true);

        return redirect('/notes');
    }

    public function hide()
    {
        session()->forget('show');

        return redirect('/notes');
    }
}