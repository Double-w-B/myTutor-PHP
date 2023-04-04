<?php

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    "/" => "controllers/registration.php",
    "/login" => "controllers/login.php",
    "/logout" => "controllers/logout.php",
    "/account" => "controllers/account.php",
    "/tutorials" => "controllers/tutorials.php",
    "/tutorials/tutorial" => "controllers/tutorial.php",
    "/tutorials/tutorial-data" => "controllers/tutorial-data.php",
    "/tutorials-user" => "controllers/tutorials-user.php",
    "/tutorials-user/tutorial-user" => "controllers/tutorial-user.php",
    "/tutorials-user/tutorial-user-data" => "controllers/tutorial-user-data.php",
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
