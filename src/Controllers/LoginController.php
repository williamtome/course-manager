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

        if (
            (is_null($email) || !$email)
            && (is_null($password) || !$password)
        ) {
            // TODO: criar uma página HTML com a mensagem de erro.
            echo 'E-mail e/ou senha inválido';
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

        if (is_null($email) || !$email) {
            echo 'E-mail inválido';
            return;
        }

        $user = $this->userRepository->findOneBy(['email' => $email]);

        if (!is_null($password) && !$user->senhaEstaCorreta($password)) {
            echo 'Usuário inválido.';
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
