<?php

use Alura\Cursos\Controllers\CursosController;

$id = $_GET['id'] ?? '';

$routes = [
    '/' => [CursosController::class, 'index'],
    '/novo-curso' => [CursosController::class, 'create'],
    '/salvar-curso' => [CursosController::class, 'store'],
    '/excluir-curso?id=' . $id => [CursosController::class, 'delete'],
];

return $routes;
