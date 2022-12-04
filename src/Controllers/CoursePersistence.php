<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\DefineMessage;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Interfaces\IControllerRequest;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class CoursePersistence implements RequestHandlerInterface
{
    use DefineMessage;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getQueryParams();  
        $post = $request->getParsedBody();

        $descricao = filter_var($post['descricao']);
        $id = filter_var($queryString['id'], FILTER_VALIDATE_INT);

        $type = 'success';

        if ($id) {
            $this->update($descricao, $id);
            $this->defineMessage($type, 'Curso atualizado com sucesso');
        } else {
            $this->setCurso($descricao);
            $this->defineMessage($type, 'Curso inserido com sucesso');
        }

        return new Response(200, ['Location' => '/courses-admin/public/listar-cursos']);
    }

    // public function processRequest(): void
    // {
    //     $descricao = filter_input(INPUT_POST, 'descricao');

    //     $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    //     $type = 'success';

    //     if ($id) {
    //         $this->update($descricao, $id);
    //         $this->defineMessage($type, 'Curso atualizado com sucesso');
    //     } else {
    //         $this->setCurso($descricao);
    //         $this->defineMessage($type, 'Curso inserido com sucesso');
    //     }
        
    //     header('Location: /courses-admin/public/listar-cursos', true, 302);
    // }

    private function update($descricao, $id)
    {
        $curso = $this->entityManager->getRepository(Curso::class)->find($id);

        if (!$curso) {
            throw new Exception("Not found id for $id");
        } 

        $coon = $this->entityManager->getConnection();

        $sql = "UPDATE cursos SET descricao = :descricao WHERE id = :id";
        $stmt = $coon->prepare($sql);
        $stmt->executeQuery([
            'descricao' => $descricao, 
            'id' => $id
        ]);
    }

    private function setCurso($descricao): void
    {   
        $curso = new Curso();
        $curso->setDescricao($descricao);
        $this->entityManager->persist($curso);
        $this->entityManager->flush();
    }
}