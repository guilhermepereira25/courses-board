<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Interfaces\IControllerRequest;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Controllers\HtmlController;

class UpdateController extends HTMLController implements IControllerRequest
{
    private $coursesRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->coursesRepository = $entityManager->getRepository(Curso::class);
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (is_null($id) || !$id) {
            header('Location: /courses-admin/public/listar-cursos', true, 302);
        }

        $curso = $this->coursesRepository->find($id);
        $titulo = 'Alterar curso' . " " . $curso->getDescricao($id);

        echo $this->renderHtml('cursos/formulario.php', [
            'curso' => $curso,
            'can_show_alerts' => true,
            'show_header' => true,
            'show_title' => true,
            'titulo' => $titulo, 
            'documentTitle' => 'Alterar Curso',
        ]);
    }
}