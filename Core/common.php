<?php

function base_path($path)
{
    // dd($path);
    // $path = "Core/Flash";
    return __DIR__ . "/../" . $path;
}

function redirect($uri)
{
    return header('Location: '.$uri);
}

function view(string $view, array $data = []): void 
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    // dd(base_path());
    require base_path("views/template/app.php");
}

function dd(...$dump): void 
{
    dump($dump);
    exit();
}

function dump(...$dump): void 
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
}

function abort(int $code): void
{
    http_response_code($code);
    view($code);
    die();
}

function flash()
{
    return new Core\Flash;
}

function config(string $key = null): array
{
    
    $config = require base_path('config/config.php');
    
    if (strlen($key) > 0) {
        return $config[$key];
    }

    return $config;
}

function auth()
{
    
    if (! isset($_SESSION['auth'])) {
        return null;
    }

    return $_SESSION['auth'];
}

function old($field)
{
    
    $post = $_POST;

    if (isset($post[$field])) {
        return $post[$field];
    }
    return '';
}
