<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

class LoginController extends BaseController
{
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
        view('login.formulario');
    }

    public function create()
    {
        view('login.novo-usuario');
    }

    public function store()
    {
        $email = $this->validate('email', INPUT_POST, FILTER_SANITIZE_EMAIL);
        $password = $this->validate('password', INPUT_POST, FILTER_SANITIZE_STRING);

        $user = $this->userRepository->findOneBy(['email' => $email]);

        if ($user) {
            $_SESSION['message_type'] = 'danger';
            $_SESSION['message'] = 'Cadastro inválido';
            header('Location: /novo-usuario');
            return;
        }

        if (
            (is_null($email) || !$email)
            && (is_null($password) || !$password)
        ) {
            $_SESSION['message_type'] = 'danger';
            $_SESSION['message'] = 'E-mail e/ou senha inválido';
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
            $_SESSION['message_type'] = 'danger';
            $_SESSION['message'] = 'E-mail inválido';
            header('Location: /login');
            return;
        }


        if (!$user->senhaEstaCorreta($password)) {
            $_SESSION['message_type'] = 'danger';
            $_SESSION['message'] = 'Usuário inválido';
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
