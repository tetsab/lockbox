<?php

namespace App\Controllers\Notes;

use Core\Validation;

class VisualizationController
{
    public function confirm()
    {
        return view('notes/confirm');
    }

    public function show()
    { 
        $validation = Validation::validate([
            'email' => ['required', 'email'],
        ], request()->all());

        if ($validation->notApproved()) {
            return view('notes/confirm');
        }


        if (!password_verify(request()->post('password'), auth()->password)) {
            flash()->push('validations', ['password' => ['Password incorrect.']]);
            return view('notes/confirm');
        }

        session()->set('show', true);

        return redirect('/notes');
    }

    public function hide()
    {
        session()->forget('show');

        return redirect('/notes');
    }
}
