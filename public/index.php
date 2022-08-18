<?php

require __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['REQUEST_URI'];
$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

session_start();

$isLoginRoute = str_contains($path, 'login');

if (
    !isset($_SESSION['auth'])
    && !$isLoginRoute
    && $path !== '/novo-usuario'
    && $path !== '/cadastrar-usuario'
) {
    header('Location: /login');
    exit();
}

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$request = $creator->fromGlobals();

$controllerClass = $routes[$path][0];
$action = $routes[$path][1];

$controller = new $controllerClass();
$response = $controller->{$action}($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
