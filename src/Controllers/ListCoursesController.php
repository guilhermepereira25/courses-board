<?php 

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class ListCoursesController extends HtmlController implements RequestHandlerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->entityManager->getRepository(Curso::class);

        $html = $this->renderHtml('cursos/listar-cursos.php', [
            'cursos' => $cursos->findAll(),
            'can_show_alerts' => true,
            'show_header' => true,
            'show_title' => true,
            'titulo' => 'Lista de cursos',
            'documentTitle' => 'Lista de cursos'
        ]);

        $response = new Response(200, [], $html);

        return $response;
    }

    // public function __construct()
    // {
    //     $entityManager = (new EntityManagerCreator())->getEntityManager();
    //     $this->coursesRepository = $entityManager->getRepository(Curso::class);
      
    // }

    // public function processRequest(): void
    // {
    //     echo $this->renderHtml('cursos/listar-cursos.php', [
    //         'cursos' => $this->coursesRepository->findAll(),
    //         'can_show_alerts' => true,
    //         'show_header' => true,
    //         'show_title' => true,
    //         'titulo' => 'Lista de cursos',
    //         'documentTitle' => 'Lista de cursos'
    //     ]);
    // }
}