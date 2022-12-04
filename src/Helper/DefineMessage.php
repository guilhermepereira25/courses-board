<?php

namespace Alura\Cursos\Helper;

trait DefineMessage
{
    public function defineMessage(string $type, string $message)
    {
        $_SESSION['message'] = $message;
        $_SESSION['message_type'] = $type;
    }
}