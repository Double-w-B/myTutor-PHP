<?php

function showInputError($errorName)
{
    if (isset($_SESSION['errors'][$errorName])) {
        echo "<p>{$_SESSION['errors'][$errorName]}</p>";
        echo "<img src='./assets/icon-error.svg' alt=''>";
        unset($_SESSION['errors'][$errorName]);
    }
}

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}


function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path)
{
    return base_path("views/" . $path);
}
