<?php

namespace Core;

class session
{
    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    function forget($key)
    {
        unset($_SESSION[$key]);
    }
}