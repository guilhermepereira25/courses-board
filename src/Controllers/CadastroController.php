<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Interfaces\{IControllerRequest, IPasswordValidate};
use Alura\Cursos\Infra\EntityManagerCreator;

class CadastroController extends HtmlController implements IControllerRequest, IPasswordValidate
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    } 

    public function processRequest(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        $senha = filter_input(INPUT_POST, 'senha');

        $validatePass = $this->validatePass($senha);

        if ($validatePass) {
            $hash = password_hash($validatePass, PASSWORD_DEFAULT);
        } else {
            echo "Este tipo de senha não é permetido";
        }
        
        $findUser = $this->entityManager->getRepository(Usuario::class)->find($email);

        if ($findUser) {
            echo "Este usuário já possui conta no sistema";
            header('Location: /courses-admin/public/login', true, 302);
            return;
        } else {
            $this->setUser($email, $hash);
        }

        header('Location: /courses-admin/public/login', true, 302);
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