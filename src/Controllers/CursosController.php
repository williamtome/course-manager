<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class CursosController
{
    private $repositorioDeCursos;
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $this->entityManager
            ->getRepository(Curso::class);
    }

    public function index()
    {
        $cursos = $this->repositorioDeCursos->findAll();

        view('listar-cursos', $cursos);
    }

    public function create()
    {
        return view('novo-curso');
    }

    public function store()
    {
        $description = $this->validate('descricao');

        $course = new Curso();
        $course->setDescricao($description);
        $this->entityManager->persist($course);
        $this->entityManager->flush();

        header('Location: /', false, 302);
    }

    protected function validate(string $field)
    {
        return filter_input(
            INPUT_POST,
            $field,
            FILTER_SANITIZE_STRING
        );
    }
}