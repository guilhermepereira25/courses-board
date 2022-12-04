<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Interfaces\IPasswordValidate;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class CadastroController implements RequestHandlerInterface, IPasswordValidate
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

        if ($validatePass) {
            $hash = password_hash($validatePass, PASSWORD_DEFAULT);
        } else {
            die();
        }

        $response = new Response(200, ['Location' => '/courses-admin/public/login']);

        $findUser = $this->entityManager->getRepository(Usuario::class)->find($email);

        if ($findUser) {
            echo "Este usuário já possui conta em nosso sistema";
        } else {
            $this->setUser($email, $hash);
        }

        return $response;
    }

    public function validatePass($senha): string
    {
        $validatePass = htmlspecialchars($senha);

        return $validatePass;
    }

    private function setUser($email, $hash): void
    {
        $user = new Usuario();
        $user->setEmail($email);
        $user->setSenha($hash);
        $user->setCreatedAt();
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}