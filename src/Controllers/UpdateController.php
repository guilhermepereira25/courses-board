<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Controllers\HtmlController;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class UpdateController extends HTMLController implements RequestHandlerInterface
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

        if (!$id) {
            echo "Curso not found";
            return new Response(200, ['Location' => '/courses-admin/public/listar-cursos']);
        } else {
            $curso = $this->entityManager->getRepository(Curso::class)->find($id);
        }

        $titulo = 'Alterar curso' . " " . $curso->getDescricao($id);

        $html = $this->renderHtml('cursos/formulario.php', [
            'curso' => $curso,
            'can_show_alerts' => true,
            'show_header' => true,
            'show_title' => true,
            'titulo' => $titulo,
            'documentTitle' => 'Alterar Curso',
        ]);

        return new Response(200, [], $html);
    }
}