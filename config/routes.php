<?php

use Alura\Cursos\Controllers\CursosController;

$routes = [
    '/' => [CursosController::class, 'index'],
    '/novo-curso' => [CursosController::class, 'create'],
    '/salvar-curso' => [CursosController::class, 'store'],
];

return $routes;
