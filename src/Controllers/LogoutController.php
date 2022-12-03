<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Interfaces\IControllerRequest;

class LogoutController implements IControllerRequest
{
    public function processRequest(): void
    {
        session_destroy();
        header('Location: /courses-admin/public/login', true, 302);
    }
}