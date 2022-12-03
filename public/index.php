<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controllers\{
    InsertFormController, 
    ListCoursesController, 
    CoursePersistence, 
    DeleteController, 
    UpdateController, 
    LoginController,
    CadastroFormController,
    CadastroController,
    RouteController};

use Alura\Cursos\Interfaces\IControllerRequest;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($requestUri, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$isValidRoute = RouteController::validateRoutes($requestUri);

$classController = $rotas[$requestUri];
$controller = new $classController();
$controller->processRequest();

?>
