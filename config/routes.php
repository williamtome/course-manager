<?php

use Alura\Cursos\Controllers\CursosController;
use Alura\Cursos\Controllers\LoginController;

$id = $_GET['id'] ?? '';

$routes = [
    '/' => [CursosController::class, 'index'],
    '/cursos/json' => [CursosController::class, 'toJson'],
    '/novo-curso' => [CursosController::class, 'create'],
    '/salvar-curso' => [CursosController::class, 'store'],
    '/excluir-curso?id=' . $id => [CursosController::class, 'delete'],
    '/alterar-curso?id=' . $id => [CursosController::class, 'edit'],
    '/atualizar-curso?id=' . $id => [CursosController::class, 'update'],
    '/login' => [LoginController::class, 'index'],
    '/realiza-login' => [LoginController::class, 'autenticate'],
    '/logout' => [LoginController::class, 'logout'],
    '/novo-usuario' => [LoginController::class, 'create'],
    '/cadastrar-usuario' => [LoginController::class, 'store'],
];

return $routes;
