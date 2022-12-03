<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Interfaces\IControllerRequest;
use Exception;

class CoursePersistence implements IControllerRequest
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processRequest(): void
    {
        $descricao = filter_input(INPUT_POST, 'descricao');

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $this->update($descricao, $id);
            $_SESSION['message'] = 'Curso atualizado com sucesso';
        } else {
            $this->setCurso($descricao);
            $_SESSION['message'] = 'Curso inserido com sucesso';
        }

        $_SESSION['message_type'] = 'success';
        
        header('Location: /courses-admin/public/listar-cursos', true, 302);
    }

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