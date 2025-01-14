<?php

namespace Core;

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notes\CreateController;
use App\Controllers\Notes\DeleteController;
use App\Middlewares\GuestMiddleware;
use App\Middlewares\AuthMiddleware;
use App\Controllers\Notes;


(new Route())
    // not authenticated
    ->get('/', IndexController::class, GuestMiddleware::class)
    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)
    ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)
    
    // authenticated
    ->get('/logout', LogoutController::class, AuthMiddleware::class)  
    ->get('/notes', Notes\IndexController::class, AuthMiddleware::class)
    ->get('/notes/create', [CreateController::class, 'index'], AuthMiddleware::class)
    ->post('/notes/create', [CreateController::class, 'store'], AuthMiddleware::class)
    ->put('/note', Notes\UpdateController::class, AuthMiddleware::class)
    ->delete('/note', Notes\DeleteController::class, AuthMiddleware::class)
    
    ->run();
    