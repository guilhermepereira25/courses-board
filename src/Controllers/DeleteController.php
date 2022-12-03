<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Interfaces\IControllerRequest;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class DeleteController implements IControllerRequest
{
    private $entityManager;

    public function __construct()
    {
       $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || is_null($id)) {
            header('Location: /courses-admin/public/listar-cursos');
            return;
        }

        $curso = $this->entityManager->getReference(Curso::class, $id);
        
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        header('Location: /courses-admin/public/listar-cursos', true, 302);
    }

}