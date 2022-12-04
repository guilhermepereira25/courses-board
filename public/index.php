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

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($requestUri, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$serverRequest = $creator->fromGlobals();

$isValidRoute = RouteController::validateRoutes($requestUri);

$classController = $rotas[$requestUri];
$container = require __DIR__ . '/../config/dependencies.php';
$controller = $container->get($classController);

$response = $controller->handle($serverRequest);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();

?>
