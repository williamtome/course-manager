<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;

class CursosController
{
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();

        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class);
    }

    public function index()
    {
        $cursos = $this->repositorioDeCursos->findAll();
        var_dump($cursos);
        die();

        view('listar-cursos', ['cursos' => $cursos]);
    }
}