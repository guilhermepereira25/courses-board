<?php

use Alura\Cursos\Controllers\{
    CadastroController,
    InsertFormController, 
    ListCoursesController, 
    CoursePersistence, 
    DeleteController, 
    LoginFormController, 
    UpdateController, 
    LoginController,
    CadastroFormController,
    LogoutController,
    GetCourses};

$rotas = [
    '/courses-admin/public/listar-cursos' => ListCoursesController::class,
    '/courses-admin/public/novo-curso' => InsertFormController::class,
    '/courses-admin/public/salvar-curso' => CoursePersistence::class,
    '/courses-admin/public/excluir-curso' => DeleteController::class,
    '/courses-admin/public/alterar-curso'=> UpdateController::class,
    '/courses-admin/public/login' => LoginFormController::class,
    '/courses-admin/public/realiza-login' => LoginController::class,
    '/courses-admin/public/cadastro' => CadastroFormController::class,
    '/courses-admin/public/realiza-cadastro' => CadastroController::class,
    '/courses-admin/public/logout' => LogoutController::class,
    '/courses-admin/public/getCourses' => GetCourses::class,
];

return $rotas;