<?php

require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'database' => [
        // 'driver'=> 'sqlite',
        // 'database' => base_path('database/database.sqlite')
        
        'driver' => env('DB_DRIVER'),
        'host' => env('DB_HOST'),
        'port' => env('DB_PORT'),
        'dbname' => env('DB_NAME'),
        'user' => env('DB_USER'),
        'charset' => env('DB_CHARSET'),
    ],

    // Create The First Key
    // echo base64_encode(openssl_random_pseudo_bytes(32));
    // echo '<br>';
    // Create The Second Key
    // echo base64_encode(openssl_random_pseudo_bytes(64));

    'security' => [
        'first_key' => env('ENCRYPT_FIRST_KEY', 'ANOTHER_OPTION'),
        'second_key' => env('ENCRYPT_SECOND_KEY', 'ANOTHER_OPTION'),
    ]

];
