<?php

namespace  Application\Source\Controllers;

use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class LogoutController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy();

        return new Response(200, ['Location' => '/courses-admin/public/login']);
    }
}