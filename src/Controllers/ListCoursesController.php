<?php 

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Interfaces\IControllerRequest;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListCoursesController extends HtmlController implements IControllerRequest
{
    private $coursesRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->coursesRepository = $entityManager->getRepository(Curso::class);
      
    }

    public function processRequest(): void
    {
        echo $this->renderHtml('cursos/listar-cursos.php', [
            'cursos' => $this->coursesRepository->findAll(),
            'can_show_alerts' => true,
            'show_header' => true,
            'show_title' => true,
            'titulo' => 'Lista de cursos',
            'documentTitle' => 'Lista de cursos'
        ]);
    }
}