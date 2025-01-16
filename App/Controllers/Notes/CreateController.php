<?php


namespace App\Controllers\Notes;

use Core\Validation;
use Core\Database;
use App\Models\Note;

class CreateController
{
    public function index()
    {
        return view('notes/create', [
            'user' => auth()
        ]);
    }

    public function store()
    {
        $validation = Validation::validate([
            'title' => ['required', 'min:3', 'max:255'],
            'note' => ['required'],
        ], request()->all());

        if ($validation->notApproved()) {
            return view('notes/create');
        }

        Note::create([
            'user_id' => auth()->id,
            'title' => request()->post('title'),
            'note' => encrypt(request()->post('note')),
        ]);

        flash()->push('message', 'Note created successfully.');
        
        return redirect('/notes'); 
    }   
}
