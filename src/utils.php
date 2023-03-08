<?php

function rememberInputValue($inputValue)
{
    if (isset($_SESSION[$inputValue])) {
        echo $_SESSION[$inputValue];
        unset($_SESSION[$inputValue]);
    }
}


function showInputError($errorName)
{
    if (isset($_SESSION[$errorName])) {
        echo "<p>$_SESSION[$errorName]</p>";
        echo "<img src='./assets/icon-error.svg' alt=''>";
        unset($_SESSION[$errorName]);
    }
}
