<?php

namespace App\Controllers\Notes;

use Core\Database;
use Core\Validation;

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

        $db = new Database(config('database'));
        $db->query(
            query: "
                update notes
                set title = :title, 
                note = :note
                where id = :id",
            params: [
                'title' => request()->post('title'),
                'note' => request()->post('note'),
                'id' => request()->post('id'),
            ],
        );
        
        flash()->push('message', 'Registered successfully!');
        
        return redirect('/notes');
    }
}
