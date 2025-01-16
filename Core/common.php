<?php

function base_path($path)
{
    return __DIR__ . '/../' . $path;
}

function redirect($uri)
{
    return header('Location: ' . $uri);
}

function view(string $view, array $data = [], $template = 'app'): void
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require base_path("views/template/$template.php");
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
    return new Core\Flash();
}

function config(string $key = null): array
{
    $config = require base_path('config/config.php');

    if (strlen($key) > 0) {
        $tmp = null;

        foreach(explode('.', $key) as $index => $key) {
            $tmp = $index == 0 ? $config[$key] : $tmp[$key];

        }
        
        return $tmp;
    }

    return $config;
}

function auth()
{
    if (!isset($_SESSION['auth'])) {
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

function request()
{
    return new Core\Request();
}

function session()
{
    return new Core\Session();
}

function encrypt($data)
{
    $first_key = base64_decode(config('security.first_key'));
    $second_key = base64_decode(config('security.second_key'));

    $method = 'aes-256-cbc';
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);

    $first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, true);

    $output = base64_encode($iv . $second_encrypted . $first_encrypted);
    return $output;
}

function decrypt($input)
{
    $first_key = base64_decode(config('security.first_key'));
    $second_key = base64_decode(config('security.second_key'));

    $mix = base64_decode($input);

    $method = 'aes-256-cbc';
    $iv_length = openssl_cipher_iv_length($method);

    $iv = substr($mix, 0, $iv_length);
    $second_encrypted = substr($mix, $iv_length, 64);
    $first_encrypted = substr($mix, $iv_length + 64);

    $data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, true);

    if (hash_equals($second_encrypted, $second_encrypted_new)) {
        return $data;
    }

    return false;
}

function env($key, $default = null)
{
    $env = parse_ini_file(base_path('config/.env'));

    return isset($env[$key]) ? $env[$key] : $default;
}