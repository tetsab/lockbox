<?php

namespace App\Controllers;

use Core\Validation;
use Core\Database;
use App\Models\User;

class LoginController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $validation = Validation::validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $_POST);

        if ($validation->notApproved()) {
            return view('login');
        }

        $database = new Database(config('database'));

        

        $user = $database->query(query: "SELECT * FROM users 
                                WHERE email = :email",
                            class: User::class,
                            params: compact('email')
                            )->fetch();

        $passwordPost = $_POST['password'];
        $passwordHash = $user->password;

        if (!($user && password_verify($passwordPost, $passwordHash))) {
            flash()->push('validations', ['email' => ['User or password incorrect. Try again.']]);
            return view('login');
        }

        $_SESSION['auth'] = $user;
    
        flash()->push('message', 'Welcome, '.$user->name.'!');
        
        return redirect('/dashboard');
    }
}
