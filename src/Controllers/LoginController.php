<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Traits\FlashMessageTrait;
use Alura\Cursos\Traits\ViewRenderTrait;

class LoginController extends BaseController
{
    use FlashMessageTrait, ViewRenderTrait;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $userRepository;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(Usuario::class);
    }

    public function index()
    {
        $this->view('login.formulario');
    }

    public function create()
    {
        $this->view('login.novo-usuario');
    }

    public function store()
    {
        $email = $this->validate('email', INPUT_POST, FILTER_SANITIZE_EMAIL);
        $password = $this->validate('password', INPUT_POST, FILTER_SANITIZE_STRING);

        $user = $this->userRepository->findOneBy(['email' => $email]);

        if ($user) {
            $this->defineMessage('danger', 'Cadastro inválido.');
            header('Location: /novo-usuario');
            return;
        }

        if (
            (is_null($email) || !$email)
            && (is_null($password) || !$password)
        ) {
            $this->defineMessage('danger', 'E-mail e/ou senha inválido.');
            header('Location: /novo-usuario');
            return;
        }

        $user = new Usuario();
        $user->setEmail($email);
        $user->setSenha($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $_SESSION['auth'] = true;

        header('Location: /');
    }

    public function autenticate()
    {
        $email = $this->validate('email', INPUT_POST, FILTER_SANITIZE_EMAIL);
        $password = $this->validate('password', INPUT_POST, FILTER_SANITIZE_STRING);

        $user = $this->userRepository->findOneBy(['email' => $email]);

        if (is_null($email) || is_null($user)) {
            $this->defineMessage('danger', 'E-mail inválido.');
            header('Location: /login');
            return;
        }

        if (!$user->senhaEstaCorreta($password)) {
            $this->defineMessage('danger', 'Usuário inválido.');
            header('Location: /login');
            return;
        }

        $_SESSION['auth'] = true;

        header('Location: /');
    }

    public function logout()
    {
        session_destroy();

        header('Location: /login');
    }
}
