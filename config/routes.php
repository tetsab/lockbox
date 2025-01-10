<?php

namespace Core;

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\DashboardController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notes\CreateController;

(new Route())
    ->get('/', IndexController::class)
    
    ->get('/login', [LoginController::class, 'index'])
    ->post('/login', [LoginController::class, 'login'])
    
    ->get('/dashboard', DashboardController::class)
    ->get('/notes/create', [CreateController::class, 'index'])
    ->post('/notes/create', [CreateController::class, 'store'])
    
    ->get('/logout', LogoutController::class, 'login')
    
    ->get('/register', [RegisterController::class, 'index'])
    ->post('/register', [RegisterController::class, 'register'])
    

    ->run();