<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Interfaces\IControllerRequest;
use Alura\Cursos\Controllers\HtmlController;

class InsertFormController extends HtmlController implements IControllerRequest
{
    public function processRequest(): void
    {
        echo $this->renderHtml('cursos/formulario.php', [
            'can_show_alerts' => true,
            'show_header' => true,
            'show_title' => true,
            'titulo' => 'Adicionar Curso',
            'documentTitle' => 'Adicionar Curso'
        ]);
    }
}