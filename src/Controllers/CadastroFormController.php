<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\HtmlController;
use Alura\Cursos\Interfaces\IControllerRequest;

class CadastroFormController extends HtmlController implements IControllerRequest
{
    public function processRequest(): void
    {
        echo $this->renderHtml('cadastro/formulario.php', [
            'can_show_alerts' => false,
            'show_header' => false,
            'show_title' => false,
            'titulo' => 'Cadastro',
            'documentTitle' => 'Cadastro',
        ]);
    }
}