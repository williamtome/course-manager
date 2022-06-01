<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controllers\CursosController;
use Alura\Cursos\Infra\EntityManagerCreator;

$request = $_SERVER['REQUEST_URI'];
$entityManager = (new EntityManagerCreator())->getEntityManager();
$controller = new CursosController($entityManager);

switch ($request) {
    case '/':
        $controller->index();
        break;
    case '/novo-curso':
        $controller->create();
        break;
    case '/salvar-curso':
        $controller->store();
        break;
    default:
        echo "Error 404!";
}
