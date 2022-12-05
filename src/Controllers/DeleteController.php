<?php

namespace  Application\Source\Controllers;

use  Application\Source\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
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
}