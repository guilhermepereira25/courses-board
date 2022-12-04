<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Interfaces\IPasswordValidate;
use Alura\Cursos\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class LoginController implements RequestHandlerInterface, IPasswordValidate
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post = $request->getParsedBody();

        $email = filter_var($post['email'], FILTER_VALIDATE_EMAIL);
        $senha = filter_var($post['senha']);

        $validatePass = $this->validatePass($senha);

        $user = $this->entityManager->getRepository(Usuario::class);
        $user->findOneBy(['email' => $email]);

        if (!$user && !$user->senhaEstaCorreta($validatePass)) {
            echo "Email ou senha inválidos";
            return new Response(200, ['Location' => '/courses-admin/public/login']);
        }

        $_SESSION['logged'] = true;

        return new Response(200, ['Location' => '/courses-admin/public/listar-cursos']);
    }

    // public function __construct()
    // {
    //     $entityManager = (new EntityManagerCreator())->getEntityManager();
    //     $this->usersRepository = $entityManager->getRepository(Usuario::class);
    // }

    // public function processRequest(): void
    // {
    //     $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    //     $senha = filter_input(INPUT_POST, 'senha');

    //     $validatePass = $this->validatePass($senha);

    //     $user = $this->usersRepository->findOneBy(['email' => $email]);

    //     if (!$user || !$user->senhaEstaCorreta($validatePass)) {
    //         echo "Email ou senha inválidos";
    //         return;
    //     }

    //     $_SESSION['logged'] = true;

    //     header('Location: /courses-admin/public/listar-cursos', true, 302); 
    // }

    public function validatePass($senha): string
    {
        $validatePass = htmlspecialchars($senha);

        return $validatePass;
    }
}