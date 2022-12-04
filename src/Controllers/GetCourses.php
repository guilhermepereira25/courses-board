<?php

namespace Alura\Cursos\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;
use Alura\Cursos\Entity\Curso;

class GetCourses implements RequestHandlerInterface
{
    private $coursesRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->coursesRepository = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->coursesRepository->findAll();

        return new Response(200, [], json_encode($cursos));
    }
}