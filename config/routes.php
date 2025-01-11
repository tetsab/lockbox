<?php

namespace Core;

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notes\CreateController;
use App\Middlewares\GuestMiddleware;
use App\Controllers\Notes;


(new Route())
    // not authenticated
    ->get('/', IndexController::class, GuestMiddleware::class)
    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)
    ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)
    
    // authenticated
    ->get('/logout', LogoutController::class)  
    ->get('/notes', Notes\IndexController::class)
    ->get('/notes/create', [CreateController::class, 'index'])
    ->post('/notes/create', [CreateController::class, 'store'])
    
    ->run();
    