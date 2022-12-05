<?php

namespace  Application\Source\Controllers;

use  Application\Source\Controllers\HtmlController;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class InsertFormController extends HtmlController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderHtml('cursos/formulario.php', [
            'can_show_alerts' => true,
            'show_header' => true,
            'show_title' => true,
            'titulo' => 'Adicionar Curso',
            'documentTitle' => 'Adicionar Curso'
        ]);

        return new Response(200, [], $html);
    }
}