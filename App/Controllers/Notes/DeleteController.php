<?php

namespace App\Controllers\Notes;

use Core\Database;
use Core\Validation;
use App\Models\Note;

class DeleteController
{
    public function __invoke()
    {
        $validation = Validation::validate([
            'id' => ['required'],
        ], request()->all());

        if ($validation->notApproved()) {
            return redirect('/notes?id='.request()->post('id'));
        }
        Note::delete(request()->post('id'));
        
        flash()->push('message', 'Register deleted successfully!');
        
        return redirect('/notes');
    }
}
