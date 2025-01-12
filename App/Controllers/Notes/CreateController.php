<?php


namespace App\Controllers\Notes;

use Core\Validation;
use Core\Database;

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
        ], $_POST);

        if ($validation->notApproved()) {
            return view('notes/create');
        }

        $database = new Database(config('database'));

        $database->query(
            "insert into notes 
            (user_id, title, note, date_creation, date_update) 
            values (:user_id, :title, :note, :date_creation, :date_update)",
            params: [
                'user_id' => auth()->id,
                'title' => $_POST['title'],
                'note' => $_POST['note'], // criptography
                'date_creation' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s')
        ]);


        flash()->push('message', 'Note created successfully.');
        return redirect('/notes');
        
    }   
}
