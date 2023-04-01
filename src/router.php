<?php

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    "/" => "controllers/registration.php",
    "/login" => "controllers/login.php",
    "/logout" => "controllers/logout.php",
    "/tutorials" => "controllers/tutorials.php",
    "/account" => "controllers/account.php",
    "/my-tutorials" => "controllers/my-tutorials.php",
    "/my-tutorials/user-tutorial" => "controllers/user-tutorial.php",
    "/my-tutorials/user-tutorial-data" => "controllers/user-tutorial-data.php",
    "/subscription" => "controllers/subscription.php",
];


function routeToController($url, $routes)
{
    if (!array_key_exists($url, $routes)) {
        abort();
    }
    
    require $routes[$url];
}

routeToController($url, $routes);
