<?php

require __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['REQUEST_URI'];
$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

$controllerClass = $routes[$path][0];
$action = $routes[$path][1];

$controller = new $controllerClass();
$controller->{$action}();
