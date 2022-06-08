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

    /**
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function delete()
    {
        $id = $this->validate('id', INPUT_GET, FILTER_VALIDATE_INT);

        if (is_null($id) || !$id) {
            header('Location: /');
            return;
        }

        $course = $this->entityManager->getReference(Curso::class, $id);

        $this->entityManager->remove($course);
        $this->entityManager->flush();

        header('Location: /');
    }

    protected function validate(string $field, string $method, string $filterType)
    {
        return filter_input($method, $field, $filterType);
    }
}