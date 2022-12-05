<?php

namespace  Application\Source\Controllers;

class RouteController 
{   
    //gambiarra para redirecionar para cadastro
    public static function validateRoutes($requestUri)
    {
        $isLoginRoute = str_contains($requestUri, 'login');
        $isSingUpRoute = str_contains($requestUri, 'cadastro');
        $isCadastroUrl = str_contains($requestUri, 'realiza-cadastro');

        if (!isset($_SESSION['logged']) && !$isLoginRoute) {
            if ($isSingUpRoute || $isCadastroUrl) {
                return true;
            } else {
                header("Location: /courses-admin/public/login", true, 302);
                exit();
            }
        }
    }
}   