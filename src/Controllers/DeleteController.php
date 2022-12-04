<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class DeleteController implements RequestHandlerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getQueryParams();
        $id = filter_var($queryString['id'], FILTER_VALIDATE_INT);

        $entity = $this->entityManager->getReference(Curso::class, $id);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return new Response(200, ['Location' => '/courses-admin/public/listar-cursos']);
    }

    // public function processRequest(): void
    // {
    //     $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    //     if ($id === false || is_null($id)) {
    //         header('Location: /courses-admin/public/listar-cursos');
    //         return;
    //     }

    //     $curso = $this->entityManager->getReference(Curso::class, $id);
        
    //     $this->entityManager->remove($curso);
    //     $this->entityManager->flush();
    //     header('Location: /courses-admin/public/listar-cursos', true, 302);
    // }

}