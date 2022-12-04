<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\HtmlController;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class LoginFormController extends HtmlController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {        
        $html = $this->renderHtml('login/formulario.php', [
            'can_show_alerts' => false,
            'show_header' => false,
            'show_title' => false,
            'titulo' => 'Login',
            'documentTitle' => 'Login',
        ]);

        $response = new Response(200, [], $html);

        return $response;
    }
}