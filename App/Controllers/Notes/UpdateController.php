<?php

namespace App\Controllers\Notes;

use Core\Database;
use Core\Validation;
use App\Models\Note;

class UpdateController
{
    public function __invoke()
    {
        $validation = Validation::validate([
            'title' => ['required', 'min:3', 'max:255'],
            'note' => ['required'],
            'id' => ['required'],
        ], request()->all());

        if ($validation->notApproved()) {
            return redirect('/notes?id='.request()->post('id'));
        }

        Note::update(request()->post('id'), request()->post('note'), request()->post('note'));
        
        flash()->push('message', 'Registered successfully!');
        
        return redirect('/notes');
    }
}
