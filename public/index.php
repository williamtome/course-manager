<?php

use Alura\Cursos\Controller\CursosController;

$request = $_SERVER['REQUEST_URI'];

if ($request === '/') {
    $controller = new CursosController();
    var_dump($request); die();
    $controller->index();
} else if(! $request) {
    echo "Error 404!";
} else {
    require __DIR__ . $request . '.php';
}
