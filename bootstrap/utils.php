<?php

function env($key)
{
    static $env;
    if (is_null($env)) {
        $envPath = __DIR__ . '/../.env';
        if (file_exists($envPath)) {
            $env = parse_ini_file($envPath);
        } else {
            throw new Exception('Файл .env не определен.');
        }
    }
    if (key_exists($key, $env)) {
        return $env[$key];
    }
    throw new Exception('Неопределенный ключ.');
}

function view($templatePath, $data = []): string
{
    $templateFullPath = __DIR__ . '/../app/view/' . $templatePath;
    extract($data);

    if (isset($_SESSION['login'])) {
        $sessionLogin = $_SESSION['login'];
    }
    if (isset($_SESSION['message'])) {
        $successMessage = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }

    require_once $templateFullPath;
    return '';
}

function getRequestParam($key, $default)
{
    if (key_exists($key, $_REQUEST)) {
        return $_REQUEST[$key];
    }
    return $default;
}

function url($path) {
    return env('APP_URL') . $path;
}
