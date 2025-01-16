<?php

namespace App\Controllers;
use Core\Validation;
use Core\Database;
use App\Models\User;

class RegisterController
{
    public function index()
    {
        return view('register', template: 'guest');
    }

    public function register()
    {
        $database = new Database(config('database'));

        $validation = Validation::validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'confirmed', 'unique:users'],
            'password' => ['required', 'min:8', 'max:30', 'strong'],
        ], request()->all());
        
        
        if ($validation->notApproved()) {
            return view('register', template: 'guest');
        }
    
        $database->query(
            query: "INSERT INTO users (name, email, password) 
            VALUES (:name, :email, :password)",
            params: [
                'name' => request()->post('name'),
                'email' => request()->post('email'),
                'password' => password_hash(request()->post('password'), PASSWORD_BCRYPT),
            ]
        );
    
        flash()->push('message', 'User registered successfully! 👍');
        return redirect('/login');
    }
}
