<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Factories\XMLFactory;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Traits\FlashMessageTrait;
use Alura\Cursos\Traits\ViewRenderTrait;

class CursosController extends BaseController
{
    use FlashMessageTrait, ViewRenderTrait;

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

        $this->view('cursos.listar-cursos', $cursos);
    }

    public function create()
    {
        return $this->view('cursos.novo-curso');
    }

    public function store()
    {
        $description = $this->validate('descricao', INPUT_POST, FILTER_SANITIZE_STRING);

        $course = new Curso();
        $course->setDescricao($description);
        $this->entityManager->persist($course);
        $this->entityManager->flush();

        $this->defineMessage('success', 'Curso cadastrado com sucesso.');

        header('Location: /', false, 302);
    }

    public function edit()
    {
        $id = $this->validate('id', INPUT_GET, FILTER_VALIDATE_INT);

        if (is_null($id) || !$id) {
            $this->defineMessage('danger', 'Erro ao editar curso.');
            header('Location: /');
            return;
        }

        $course = $this->repositorioDeCursos->find($id);

        $this->view('cursos.alterar-curso', [$course]);
    }

    public function update()
    {
        $id = $this->validate('id', INPUT_GET, FILTER_VALIDATE_INT);
        $description = $this->validate('descricao', INPUT_POST, FILTER_SANITIZE_STRING);

        if (is_null($id) || !$id) {
            $this->defineMessage('danger', 'Erro ao atualizar curso.');
            header('Location: /');
            return;
        }

        $course = $this->repositorioDeCursos->find($id);
        $course->setId($id);
        $course->setDescricao($description);

        $this->entityManager->merge($course);
        $this->entityManager->flush();

        $this->defineMessage('success', 'Curso atualizado com sucesso.');

        header('Location: /', false, 302);
    }

    /**
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function delete()
    {
        $id = $this->validate('id', INPUT_GET, FILTER_VALIDATE_INT);

        if (is_null($id) || !$id) {
            $this->defineMessage('danger', 'Erro ao remover curso.');
            header('Location: /');
            return;
        }

        $course = $this->entityManager
            ->getReference(Curso::class, $id);

        $this->entityManager->remove($course);
        $this->entityManager->flush();

        $this->defineMessage('success', 'Curso removido com sucesso.');

        header('Location: /');
    }

    public function toJson()
    {
        $courses = $this->repositorioDeCursos->findAll();

        header('Content-Type: application/json');

        echo json_encode($courses);
    }

    public function toXml()
    {
        $courses = $this->repositorioDeCursos->findAll();

        $xmlFactory = new XMLFactory();
        echo $xmlFactory->create($courses, '<cursos/>');
    }
}
