<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

function showInputError($errorName)
{
    if (isset($_SESSION['errors'][$errorName])) {
        echo "<p>{$_SESSION['errors'][$errorName]}</p>";
        echo "<img src='./assets/icon-error.svg' alt=''>";
        unset($_SESSION['errors'][$errorName]);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path)
{
    return base_path("views/" . $path);
}

function checkIcon($arrKey, $forI)
{
    if ($arrKey == 0) {
        if ($forI === 3 || $forI === 4 || $forI === 5 || $forI === 6 || $forI === 7) {
            return "cross";
        } else {
            return "check";
        }
    }
    if ($arrKey == 1) {
        if ($forI === 5 || $forI === 6 || $forI === 7) {
            return "cross";
        } else {
            return "check";
        }
    }
    if ($arrKey == 2) {
        return "check";
    }
}

function logout()
{
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    header("location: /");
}
