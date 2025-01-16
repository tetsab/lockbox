<?php

namespace App\Controllers\Notes;

use Core\Database;
use Core\Validation;
use App\Models\Note;

class UpdateController
{
    public function __invoke()
    {
        $validation = Validation::validate(
            array_merge(
                [
                    'title' => ['required', 'min:3', 'max:255'],
                    'id' => ['required'],
                ],
                session()->get('show') ? ['note' => ['required']] : [],
            ),
            request()->all(),
        );

        if ($validation->notApproved()) {
            return redirect('/notes?id=' . request()->post('id'));
        }

        Note::update(request()->post('id'), request()->post('title'), request()->post('note'));

        flash()->push('message', 'Registered successfully!');

        return redirect('/notes');
    }
}
