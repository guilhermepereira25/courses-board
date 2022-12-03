<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Interfaces\{IControllerRequest, IPasswordValidate};
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Usuario;

class LoginController implements IControllerRequest, IPasswordValidate
{
    private $usersRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->usersRepository = $entityManager->getRepository(Usuario::class);
    }

    public function processRequest(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        $senha = filter_input(INPUT_POST, 'senha');

        $validatePass = $this->validatePass($senha);

        $user = $this->usersRepository->findOneBy(['email' => $email]);

        if (!$user || !$user->senhaEstaCorreta($validatePass)) {
            echo "Email ou senha inválidos";
            return;
        }

        $_SESSION['logged'] = true;

        header('Location: /courses-admin/public/listar-cursos', true, 302); 
    }

    public function validatePass($senha): string
    {
        $validatePass = htmlspecialchars($senha);

        return $validatePass;
    }
}