<?php

namespace Alura\Cursos\Controllers;

abstract class HtmlController 
{
    public function renderHtml(string $pathToTemplate, array $data): string
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../../view/' . $pathToTemplate;
        $html  = ob_get_clean();

        return $html;
    }
}