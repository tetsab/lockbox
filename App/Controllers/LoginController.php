<?php

namespace App\Controllers;

use Core\Validation;
use Core\Database;
use App\Models\User;

class LoginController
{
    public function index()
    {
        return view('login', template: 'guest');
    }

    public function login()
    {
        $email = request()->post('email');
        $password = request()->post('password');

        $validation = Validation::validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], request()->all());

        if ($validation->notApproved()) {
            return view('login', template: 'guest');
        }

        $database = new Database(config('database'));

        

        $user = $database->query(query: "SELECT * FROM users 
                                WHERE email = :email",
                            class: User::class,
                            params: compact('email')
                            )->fetch();

        $passwordPost = $password;
        $passwordHash = $user->password;

        if (!($user && password_verify($passwordPost, $passwordHash))) {
            flash()->push('validations', ['email' => ['User or password incorrect. Try again.']]);
            return view('login', template: 'guest');
        }


        session()->set('auth', $user);
    
        flash()->push('message', 'Welcome, '.$user->name.'!');
        
        return redirect('/notes');
    }
}
