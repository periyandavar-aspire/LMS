<?php
//defined('VALID_REQ') OR exit('Not a valid Request');

function baseURL(): string
{
    global $config;
    return $config['base_url'];
}

function setSessionData(string $key, string $value)
{
    $value = base64_encode($value);
    $_SESSION[$key] = $value;
}

function ctrlFromSession(string $key): ?Controller
{
    $value = (new InputData)->session($key);
    if ($value == null) {
        return null;
    }
    $value = ucfirst($value) . "Controller";
    return new $value();
}

function staticCtrlFromSession(string $key): ?string
{
    $value = (new InputData)->session($key);
    if ($value == null) {
        return null;
    }
    $value = ucfirst($value) . "Controller";
    return $value;
}